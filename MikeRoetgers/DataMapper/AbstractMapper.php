<?php

namespace MikeRoetgers\DataMapper;

abstract class AbstractMapper
{
    /**
     * @param string $key
     * @param array $mapping
     * @return string
     */
    public function applyMapping($key, array $mapping)
    {
        if (isset($mapping[$key])) {
            return $mapping[$key];
        }
        return $key;
    }
}