# Types of injection

From this slide http://www.slideshare.net/cakper/dependency-27610152

## Constructor

````
class Cache
{
    private $storage;
    
    public function __construct($storage)
    {
        $this->storage = $storage;
    }
}

$s = new RedisStorage();
$c = new Cache($s);
````

so if we wan't to solve the storage automatically, we need to use reflection to get
the name of the params used in the construct function, and inject using their name?

- Laravel seems to be using this `Container\Container.php` method `build` line 760

## Setter 

````
class Cache
{
    private $storage;
    
    public function setStorage($storage)
    {
        $this->storage = $storage;
    }
}

$c = new Cache();
$s = new RedisStorage();
$c->setStorage($s);
````

- Symfony allow using this by adding a `addMethodCall`

## Property 

````
class Cache
{
    public $storage
}

$c = new Cache();
$s = new RedisStorage();
$c->storage = $s;
````

- This is not a good practice I think, maybe use comment so we know we can inject this property

## Reflection

comment, constructor params

````
class Cache
{
    private $storage;
}

$c = new Cache();
$reflector = new ReflectionClass($c);
$storage = $reflector->getProperty('storage');
$storage->setAccessible(true);
$storage->setValue($c, new RedisStorage());
````

- Using reflection, you don't need to specify the dependency for every class, make things easier
but this is low efficient I guess.