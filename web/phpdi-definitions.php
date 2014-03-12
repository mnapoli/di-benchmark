<?php

use Benchmark\Fixture\Bar;
use Benchmark\Fixture\Baz;
use Benchmark\Fixture\Foo;

return [
    'abc' => DI\object('Benchmark\Fixture\Bar')
            ->constructor(DI\link('bcd')),
    'bcd' => DI\object('Benchmark\Fixture\Baz'),
    'cde' => DI\object('Benchmark\Fixture\Foo')
        ->constructor(DI\link('abc'), DI\link('bcd')),
];
