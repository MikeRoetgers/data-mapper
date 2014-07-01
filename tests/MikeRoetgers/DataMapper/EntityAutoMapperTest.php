<?php

namespace MikeRoetgers\DataMapper;

class EntityAutoMapperTest extends \PHPUnit_Framework_TestCase
{
    public function testAutoGet()
    {
        $entity = $this->getMockBuilder('\stdClass')->disableAutoload()->disableOriginalConstructor()->setMethods(array('getId'))->getMock();
        $entity->expects($this->any())->method('getId')->will($this->returnValue(1));

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
        $entity = $this->getMockBuilder('\stdClass')->disableAutoload()->disableOriginalConstructor()->setMethods(array('setId'))->getMock();
        $entity->expects($this->any())->method('setId')->with($this->equalTo(1));

        $mapper = new EntityAutoMapper();
        $mapper->autoSet('id', 1, $entity);
    }

    public function testAutoSetException()
    {
        $this->setExpectedException('Exception');
        $entity = new \stdClass();

        $mapper = new EntityAutoMapper();
        $mapper->autoSet('test', 'value', $entity, true);
    }
}