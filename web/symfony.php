<?php

use Benchmark\Fixture\Bar;
use Benchmark\Fixture\Baz;
use Benchmark\Fixture\Foo;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new ContainerBuilder();

$container->register('Benchmark\Fixture\Baz', 'Benchmark\Fixture\Baz');

$container->register('Benchmark\Fixture\Bar', 'Benchmark\Fixture\Bar')
    ->addArgument(new Reference('Benchmark\Fixture\Baz'));

$container->register('Benchmark\Fixture\Foo', 'Benchmark\Fixture\Foo')
    ->addArgument(new Reference('Benchmark\Fixture\Bar'))
    ->addArgument(new Reference('Benchmark\Fixture\Baz'));

$container->register('abc', 'Benchmark\Fixture\Bar')
    ->addArgument(new Reference('bcd'));
$container->register('bcd', 'Benchmark\Fixture\Baz');
$container->register('cde', 'Benchmark\Fixture\Foo')
    ->addArgument(new Reference('abc'))
    ->addArgument(new Reference('bcd'));

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
