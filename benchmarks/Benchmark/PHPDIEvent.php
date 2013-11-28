<?php

namespace Benchmark;

use Athletic\AthleticEvent;
use Benchmark\Fixture\Foo;
use DI\Container;
use DI\ContainerBuilder;

/**
 * PHP-DI container, development configuration.
 */
class PHPDIEvent extends AthleticEvent
{
    /**
     * @var Container
     */
    private $container;

    public function classSetUp()
    {
        $this->container = ContainerBuilder::buildDevContainer();

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
        $container = ContainerBuilder::buildDevContainer();

        $container->get(Foo::class);
    }

    /**
     * @iterations 1000
     */
    public function buildAnd20Get()
    {
        $container = ContainerBuilder::buildDevContainer();

        for ($i = 0; $i < 20; $i++) {
            $container->get(Foo::class);
        }
    }
}
