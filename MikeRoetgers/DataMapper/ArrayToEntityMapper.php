<?php

namespace MikeRoetgers\DataMapper;

interface ArrayToEntityMapper
{
    public function mapArrayToEntity(array $row);
    public function massMapArrayToEntity(array $rows);
}