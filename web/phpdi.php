<?php

use Benchmark\Fixture\Foo;
use DI\ContainerBuilder;

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->setDefinitionCache(new \Doctrine\Common\Cache\ArrayCache());
$builder->addDefinitions(__DIR__ . '/phpdi-definitions.php');
$container = $builder->build();

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
