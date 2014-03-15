<?php

namespace MikeRoetgers\DataMapper;

interface EntityToJsonMapper
{
    public function mapEntityToJson($entity, array $mappings = array());
    public function massMapEntityToJson(array $entities, array $mappings = array());
}