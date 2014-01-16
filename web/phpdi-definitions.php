<?php

use Benchmark\Fixture\Bar;
use Benchmark\Fixture\Baz;
use Benchmark\Fixture\Foo;

return [
    'abc' => DI\object(Bar::class)
            ->withConstructor(DI\link('bcd')),
    'bcd' => DI\object(Baz::class),
    'cde' => DI\object(Foo::class)
        ->withConstructor(DI\link('abc'), DI\link('bcd')),
];
