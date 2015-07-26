<?php

/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-7-26
 * Time: 下午4:00
 */
class RedisStorage
{
    public $name = 'redis';
}

class Cache
{
    private $storage;

    /**
     * @param $storage
     */
    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    public function getStorageName(){
        return $this->storage->name;
    }
}

class Container
{
    public function getStorage()
    {
        return new RedisStorage();
    }

    public function getCache()
    {
        return new Cache($this->getStorage());
    }
}

$container = new Container();
echo $container->getCache()->getStorageName() . PHP_EOL;