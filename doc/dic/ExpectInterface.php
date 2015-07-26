<?php

/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-7-26
 * Time: 下午7:58
 */
interface Storage
{
    public function set($name, $value);

    public function get($name);
}

class RedisStorage implements Storage
{
    public function set($name, $value)
    {
        // ....
    }

    public function get($name)
    {
        // ...
        return 'ta da!';
    }
}

/**
 * Class Cache
 *
 * @property Storage $storage
 */
class Cache
{
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }
}