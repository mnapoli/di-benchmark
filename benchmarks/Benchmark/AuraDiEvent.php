<?php

namespace Benchmark;

use Athletic\AthleticEvent;
use Aura\Di\Config;
use Aura\Di\Container;
use Aura\Di\Forge;
use Benchmark\Fixture\Bar;
use Benchmark\Fixture\Baz;
use Benchmark\Fixture\Foo;

/**
 * Aura.Di container, basic configuration.
 */
class AuraDiEvent extends AthleticEvent
{
    /**
     * @var Container
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

    /**
     * @iterations 1000
     */
    public function buildAnd50Get()
    {
        $container = self::buildContainer();

        for ($i = 0; $i < 50; $i++) {
            $container->get(Foo::class);
        }
    }

    public static function buildContainer()
    {
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

        return $container;
    }
}
