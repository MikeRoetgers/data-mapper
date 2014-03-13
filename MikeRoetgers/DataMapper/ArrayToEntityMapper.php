<?php

namespace MikeRoetgers\DataMapper;

interface ArrayToEntityMapper
{
    public function mapArrayToEntity(array $row, array $mappings = array());
    public function massMapArrayToEntity(array $rows, array $mappings = array());
}