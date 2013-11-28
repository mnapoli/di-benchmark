<?php

namespace Benchmark;

use Athletic\AthleticEvent;
use Benchmark\Fixture\Bar;
use Benchmark\Fixture\Baz;
use Benchmark\Fixture\Foo;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Symfony container, basic configuration.
 */
class SymfonyEvent extends AthleticEvent
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    public function classSetUp()
    {
        $this->container = self::buildContainer();

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
        $container = self::buildContainer();

        $container->get(Foo::class);
    }

    /**
     * @iterations 1000
     */
    public function buildAnd20Get()
    {
        $container = self::buildContainer();

        for ($i = 0; $i < 20; $i++) {
            $container->get(Foo::class);
        }
    }

    public static function buildContainer()
    {
        $container = new ContainerBuilder();

        $container->register(Baz::class, Baz::class);

        $container->register(Bar::class, Bar::class)
            ->addArgument(new Reference(Baz::class));

        $container->register(Foo::class, Foo::class)
            ->addArgument(new Reference(Bar::class))
            ->addArgument(new Reference(Baz::class));

        return $container;
    }
}
