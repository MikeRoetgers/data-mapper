<?php

namespace MikeRoetgers\DataMapper;

interface JsonToEntityMapper
{
    public function mapJsonToEntity($json, array $mappings = array());
    public function massMapJsonToEntity(array $jsons, array $mappings = array());
}