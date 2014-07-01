<?php

namespace MikeRoetgers\DataMapper;

class GenericMapperTest extends \PHPUnit_Framework_TestCase
{
    public function testMappingEntityToArray()
    {
        $entity = new TestEntity();
        $entity->setId(1);
        $entity->setName('Mike');

        $mapper = new GenericMapper(new EntityAutoMapper(), '\\MikeRoetgers\\DataMapper\\TestEntity');
        $result = $mapper->mapEntityToArray($entity);

        $this->assertEquals(array('id' => 1, 'name' => 'Mike'), $result);
    }

    public function testMappingEntityToArrayWithCustomMapping()
    {
        $entity = new TestEntity();
        $entity->setId(1);
        $entity->setName('Mike');

        $mapper = new GenericMapper(new EntityAutoMapper(), '\\MikeRoetgers\\DataMapper\\TestEntity', array('id' => 'ArrayId'));
        $result = $mapper->mapEntityToArray($entity);

        $this->assertEquals(array('ArrayId' => 1, 'name' => 'Mike'), $result);
    }

    public function testMappingArrayToEntity()
    {
        $data = array('id' => 23, 'name' => 'Jonathan');

        $mapper = new GenericMapper(new EntityAutoMapper(), '\\MikeRoetgers\\DataMapper\\TestEntity');
        $entity = $mapper->mapArrayToEntity($data);

        $this->assertAttributeEquals(23, 'id', $entity);
        $this->assertAttributeEquals('Jonathan', 'name', $entity);
    }

    public function testMappingEntityToJson()
    {
        $entity = new TestEntity();
        $entity->setId(1);
        $entity->setName('Mike');

        $mapper = new GenericMapper(new EntityAutoMapper(), '\\MikeRoetgers\\DataMapper\\TestEntity');
        $result = $mapper->mapEntityToJson($entity);

        $this->assertEquals('{"id":1,"name":"Mike"}', $result);
    }

    public function testMappingJsonToEntity()
    {
        $json = '{"id":1,"name":"Mike"}';

        $mapper = new GenericMapper(new EntityAutoMapper(), '\\MikeRoetgers\\DataMapper\\TestEntity');
        $entity = $mapper->mapJsonToEntity($json);

        $this->assertAttributeEquals(1, 'id', $entity);
        $this->assertAttributeEquals('Mike', 'name', $entity);
    }

    public function testMassMappingArrayToEntity()
    {
        $data = array(
            0 => array('id' => 1, 'name' => 'Mike'),
            1 => array('id' => 23, 'name' => 'Jonathan')
        );

        $mapper = new GenericMapper(new EntityAutoMapper(), '\\MikeRoetgers\\DataMapper\\TestEntity');
        $entities = $mapper->massMapArrayToEntity($data);

        $this->assertCount(2, $entities);

        $this->assertAttributeEquals(1, 'id', $entities[0]);
        $this->assertAttributeEquals('Mike', 'name', $entities[0]);

        $this->assertAttributeEquals(23, 'id', $entities[1]);
        $this->assertAttributeEquals('Jonathan', 'name', $entities[1]);
    }
}
