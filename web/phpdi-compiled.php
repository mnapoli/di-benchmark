<?php

use Benchmark\Fixture\Foo;
use DI\ContainerBuilder;

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/phpdi-definitions.php');
$builder->compileContainer(__DIR__ . '/cache/phpdi');
$container = $builder->build();

for ($i = 0; $i < 50; $i++) {
    $container->get(Foo::class);
}
for ($i = 0; $i < 10; $i++) {
    $container->get('cde');
}

echo "Hello world";
