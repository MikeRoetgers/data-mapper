<?php

namespace MikeRoetgers\DataMapper;

interface EntityToJsonMapper
{
    public function mapEntityToJson($entity);
    public function massMapEntityToJson(array $entities);
}