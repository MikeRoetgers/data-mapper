<?php

namespace MikeRoetgers\DataMapper;

interface EntityToArrayMapper
{
    public function mapEntityToArray($entity, array $mappings = array());
    public function massMapEntityToArray(array $entities, array $mappings = array());
}