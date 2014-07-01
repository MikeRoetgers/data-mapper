<?php

namespace MikeRoetgers\DataMapper;

class EntityAutoMapper
{
    /**
     * @param string $key
     * @param mixed $value
     * @param object $object
     * @param bool $throwException
     * @throws \Exception
     * @return bool
     */
    public function autoSet($key, $value, $object, $throwException = false)
    {
        $method = 'set' . ucfirst($key);

        if (method_exists($object, $method)) {
            call_user_func(array($object, $method), $value);
            return true;
        }

        if ($throwException) {
            throw new \Exception('Object has no method "' . $method . '"');
        }

        return false;
    }

    /**
     * @param string $key
     * @param object $object
     * @param bool $throwException throw exception if key leads to no result
     * @return mixed
     * @throws \Exception
     */
    public function autoGet($key, $object, $throwException = false)
    {
        $method = 'get' . ucfirst($key);

        if (method_exists($object, $method)) {
            return call_user_func(array($object, $method));
        }

        if ($throwException) {
            throw new \Exception('Object has no method "' . $method . '"');
        }

        return null;
    }
}