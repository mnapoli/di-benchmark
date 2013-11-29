<?php

namespace Benchmark;

use Athletic\AthleticEvent;
use Benchmark\Fixture\Foo;
use DI\Container;
use DI\ContainerBuilder;

/**
 * PHP-DI container, compiled container.
 */
class PHPDICompiledEvent extends AthleticEvent
{
    /**
     * @var Container
     */
    private $container;

    public function classSetUp()
    {
        // Clear all files in directory
        foreach (glob(__DIR__ . '/cache/phpdi/*.php') as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        $builder = new ContainerBuilder();
        $builder->compileContainer(__DIR__ . '/cache/phpdi');
        $this->container = $builder->build();

        // Container warmup
        $this->container->get(Foo::class);
    }

    /**
     * @iterations 100000
     */
    public function get()
    {
        $this->container->get(Foo::class);
    }

    /**
     * @iterations 1000
     */
    public function buildAndGet()
    {
        $builder = new ContainerBuilder();
        $builder->compileContainer(__DIR__ . '/cache/phpdi');
        $container = $builder->build();

        $container->get(Foo::class);
    }

    /**
     * @iterations 1000
     */
    public function buildAnd20Get()
    {
        $builder = new ContainerBuilder();
        $builder->compileContainer(__DIR__ . '/cache/phpdi');
        $container = $builder->build();

        for ($i = 0; $i < 20; $i++) {
            $container->get(Foo::class);
        }
    }
}
