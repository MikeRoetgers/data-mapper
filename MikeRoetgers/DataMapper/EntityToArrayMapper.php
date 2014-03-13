<?php

namespace MikeRoetgers\DataMapper;

interface EntityToArrayMapper
{
    public function mapEntityToArray($entity, array $mappings = array());
    public function massMapArrayToEntity(array $entities, array $mappings = array());
}