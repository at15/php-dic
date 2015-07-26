<?php

/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-7-26
 * Time: 下午8:13
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

class Cache
{
    // change to public property to demonstrate the check
    public $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function set($name, $value)
    {
        if ($this->storage instanceof Storage) {
            $this->storage->set($name, $value);
        } else {
            throw new Exception('storage is not injected properly');
        }
    }
}

$redisStorage = new RedisStorage();
$cache = new Cache($redisStorage);
$cache->set('foo', 'bar');

$cache2 = new Cache($redisStorage);
$cache2->storage = [];

try {
    $cache2->set('foo', 'bar');
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
