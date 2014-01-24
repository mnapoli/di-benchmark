<?php

use Benchmark\Fixture\Foo;
use DI\ContainerBuilder;

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/phpdi-definitions.php');
$container = $builder->build();

for ($i = 0; $i < 50; $i++) {
    $container->get(Foo::class);
}
for ($i = 0; $i < 50; $i++) {
    $container->get('cde');
}

echo "Hello world";
