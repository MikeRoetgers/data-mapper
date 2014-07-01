<?php

namespace MikeRoetgers\DataMapper;

class EntityAutoMapperTest extends \PHPUnit_Framework_TestCase
{
    public function testAutoGet()
    {
        $entity = new TestEntity();
        $entity->setId('1');

        $mapper = new EntityAutoMapper();
        $id = $mapper->autoGet('id', $entity);
        $this->assertEquals(1, $id);
    }

    public function testAutoGetException()
    {
        $this->setExpectedException('Exception');
        $entity = new \stdClass();

        $mapper = new EntityAutoMapper();
        $mapper->autoGet('test', $entity, true);
    }

    public function testAutoSet()
    {
        $entity = new TestEntity();

        $mapper = new EntityAutoMapper();
        $mapper->autoSet('id', 1, $entity);

        $this->assertAttributeEquals(1, 'id', $entity);
    }

    public function testAutoSetException()
    {
        $this->setExpectedException('Exception');
        $entity = new \stdClass();

        $mapper = new EntityAutoMapper();
        $mapper->autoSet('test', 'value', $entity, true);
    }
}