<?php
use Aura\Di\Container;
use Aura\Di\Factory;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Container(new Factory);

$container->params['Benchmark\Fixture\Bar'] = [
    'baz' => $container->lazyNew('Benchmark\Fixture\Baz'),
];

$container->params['Benchmark\Fixture\Foo'] = [
    'bar' => $container->lazyNew('Benchmark\Fixture\Bar'),
    'baz' => $container->lazyNew('Benchmark\Fixture\Baz'),
];

$container->set('abc', $container->lazyNew('Benchmark\Fixture\Bar'));
$container->set('bcd', $container->lazyNew('Benchmark\Fixture\Baz'));
$container->set('cde', $container->lazyNew('Benchmark\Fixture\Foo'));
$container->set('Benchmark\Fixture\Foo', $container->lazyNew('Benchmark\Fixture\Foo'));

for ($i = 0; $i < 50; $i++) {
    $container->get('Benchmark\Fixture\Foo');
}
for ($i = 0; $i < 10; $i++) {
    $container->has('cde');
}
for ($i = 0; $i < 50; $i++) {
    $container->get('cde');
}

echo "Hello world";
