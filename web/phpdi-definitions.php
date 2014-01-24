<?php

use Benchmark\Fixture\Bar;
use Benchmark\Fixture\Baz;
use Benchmark\Fixture\Foo;

return [
    'abc' => DI\object(Bar::class)
            ->constructor(DI\link('bcd')),
    'bcd' => DI\object(Baz::class),
    'cde' => DI\object(Foo::class)
        ->constructor(DI\link('abc'), DI\link('bcd')),
];
