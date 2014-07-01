<?php

namespace MikeRoetgers\DataMapper;

interface JsonToEntityMapper
{
    public function mapJsonToEntity($json);
    public function massMapJsonToEntity(array $jsons);
}