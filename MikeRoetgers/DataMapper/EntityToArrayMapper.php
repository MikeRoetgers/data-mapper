<?php

namespace MikeRoetgers\DataMapper;

interface EntityToArrayMapper
{
    public function mapEntityToArray($entity);
    public function massMapEntityToArray(array $entities);
}