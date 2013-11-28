<?php

namespace Benchmark;

use Athletic\AthleticEvent;
use Benchmark\Fixture\Bar;
use Benchmark\Fixture\Baz;
use Benchmark\Fixture\Foo;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Symfony container, compiled to PHP code.
 */
class SymfonyCompiledEvent extends AthleticEvent
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    public function classSetUp()
    {
        $this->container = SymfonyEvent::buildContainer();

        // Dump container
        $file = __DIR__ .'/cache/SymfonyCompiledContainer.php';
        if (file_exists($file)) {
            unlink($file);
        }
        $this->container->compile();
        $dumper = new PhpDumper($this->container);
        file_put_contents(
            $file,
            $dumper->dump(['class' => 'SymfonyCompiledContainer'])
        );
        require_once $file;
        $this->container = new \SymfonyCompiledContainer();

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
        $container = new \SymfonyCompiledContainer();

        $container->get(Foo::class);
    }

    /**
     * @iterations 1000
     */
    public function buildAnd20Get()
    {
        $container = new \SymfonyCompiledContainer();

        for ($i = 0; $i < 20; $i++) {
            $container->get(Foo::class);
        }
    }
}
