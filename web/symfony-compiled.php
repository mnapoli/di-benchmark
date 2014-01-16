<?php

use Benchmark\Fixture\Bar;
use Benchmark\Fixture\Baz;
use Benchmark\Fixture\Foo;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Reference;

require_once __DIR__ . '/../vendor/autoload.php';

$file = __DIR__ .'/cache/SymfonyCompiledContainer.php';
if (file_exists($file)) {
    require_once $file;
    $container = new \SymfonyCompiledContainer();
} else {
    $container = new ContainerBuilder();

    $container->register(Baz::class, Baz::class);

    $container->register(Bar::class, Bar::class)
        ->addArgument(new Reference(Baz::class));

    $container->register(Foo::class, Foo::class)
        ->addArgument(new Reference(Bar::class))
        ->addArgument(new Reference(Baz::class));

    $container->register('abc', Bar::class)
        ->addArgument(new Reference('bcd'));
    $container->register('bcd', Baz::class);
    $container->register('cde', Foo::class)
        ->addArgument(new Reference('abc'))
        ->addArgument(new Reference('bcd'));

    $container->compile();
    $dumper = new PhpDumper($container);
    file_put_contents(
        $file,
        $dumper->dump(['class' => 'SymfonyCompiledContainer'])
    );
}


for ($i = 0; $i < 50; $i++) {
    $container->get(Foo::class);
}
for ($i = 0; $i < 10; $i++) {
    $container->get('cde');
}

echo "Hello world";
