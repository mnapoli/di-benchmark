<?php

use Aura\Di\Config;
use Aura\Di\Container;
use Aura\Di\Forge;
use Benchmark\Fixture\Bar;
use Benchmark\Fixture\Baz;
use Benchmark\Fixture\Foo;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Container(new Forge(new Config()));

$container->set(Baz::class, $container->lazyNew(Baz::class));

$container->set(Bar::class, $container->lazyNew(Bar::class));
$container->params[Bar::class] = [
    'baz' => $container->lazyGet(Baz::class),
];

$container->set(Foo::class, $container->lazyNew(Foo::class));
$container->params[Foo::class] = [
    'bar' => $container->lazyGet(Bar::class),
    'baz' => $container->lazyGet(Baz::class),
];

$container->set('abc', $container->lazyNew(Bar::class));
$container->params['abc'] = [
    'baz' => $container->lazyGet('bcd'),
];
$container->set('bcd', $container->lazyNew(Baz::class));
$container->set('cde', $container->lazyNew(Foo::class));
$container->params['cde'] = [
    'bar' => $container->lazyGet('abc'),
    'baz' => $container->lazyGet('bcd'),
];


for ($i = 0; $i < 50; $i++) {
    $container->get(Foo::class);
}
for ($i = 0; $i < 10; $i++) {
    $container->get('cde');
}

echo "Hello world";
