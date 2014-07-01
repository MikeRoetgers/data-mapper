<?php

namespace MikeRoetgers\DataMapper;

class GenericMapper implements EntityToArrayMapper, EntityToJsonMapper, ArrayToEntityMapper, JsonToEntityMapper
{
    /**
     * @var EntityAutoMapper
     */
    protected $autoMapper;

    /**
     * @var string
     */
    protected $className;

    /**
     * key => name in entity
     * value => name in array/json
     *
     * @var array
     */
    protected $mapping;

    /**
     * @var array
     */
    protected $reverseMapping;

    /**
     * @var array
     */
    protected $entityGetters;

    /**
     * @param EntityAutoMapper $autoMapper
     * @param string $className
     * @param array $mapping
     */
    public function __construct(EntityAutoMapper $autoMapper, $className, array $mapping = array())
    {
        $this->autoMapper = $autoMapper;
        $this->className = $className;
        $this->mapping = $mapping;
        $this->reverseMapping = array_flip($mapping);
    }

    /**
     * @param array $row
     * @return mixed
     */
    public function mapArrayToEntity(array $row)
    {
        $entity = $this->createNewInstance();

        foreach ($row as $key => $value) {
            $mappedKey = $this->applyReversedMapping($key);
            $this->autoMapper->autoSet($mappedKey, $value, $entity);
        }

        return $entity;
    }

    /**
     * @param array $rows
     * @return array
     */
    public function massMapArrayToEntity(array $rows)
    {
        $entities = array();

        foreach ($rows as $row) {
            $entities[] = $this->mapArrayToEntity($row);
        }

        return $entities;
    }

    /**
     * @param mixed $entity
     * @return array
     */
    public function mapEntityToArray($entity)
    {
        $result = array();
        $fields = $this->extractEntityGetters($entity);
        foreach ($fields as $name => $method) {
            $result[$this->applyMapping($name)] = $entity->$method();
        }

        return $result;
    }

    /**
     * @param array $entities
     * @return array
     */
    public function massMapEntityToArray(array $entities)
    {
        $result = array();

        foreach ($entities as $entity) {
            $result[] = $this->mapEntityToArray($entity);
        }

        return $result;
    }

    /**
     * @param mixed $entity
     * @return string
     */
    public function mapEntityToJson($entity)
    {
        $data = $this->mapEntityToArray($entity);
        return json_encode($data);
    }

    /**
     * @param array $entities
     * @return string
     */
    public function massMapEntityToJson(array $entities)
    {
        $data = $this->massMapEntityToArray($entities);
        return json_encode($data);
    }

    /**
     * @param string $json
     * @return mixed
     */
    public function mapJsonToEntity($json)
    {
        $data = json_decode($json, true);
        return $this->mapArrayToEntity($data);
    }

    /**
     * @param array $jsons
     * @return array
     */
    public function massMapJsonToEntity(array $jsons)
    {
        $rows = json_decode($jsons, true);
        return $this->massMapArrayToEntity($rows);
    }

    /**
     * @param mixed $entity
     * @return array
     */
    protected function extractEntityGetters($entity)
    {
        if (!empty($this->entityGetters)) {
            return $this->entityGetters;
        }

        $methods = get_class_methods($entity);
        foreach ($methods as $method) {
            if (mb_strpos($method, 'get') === 0) {
                $this->entityGetters[lcfirst(mb_substr($method, 3))] = $method;
            }
        }

        return $this->entityGetters;
    }

    /**
     * @param string $key
     * @return string
     */
    protected function applyMapping($key)
    {
        if (!empty($this->mapping[$key])) {
            return $this->mapping[$key];
        }
        return $key;
    }

    /**
     * @param string $key
     * @return string
     */
    protected function applyReversedMapping($key)
    {
        if (!empty($this->reverseMapping[$key])) {
            return $this->reverseMapping[$key];
        }
        return $key;
    }

    /**
     * @return mixed
     */
    protected function createNewInstance()
    {
        return new $this->className();
    }
}