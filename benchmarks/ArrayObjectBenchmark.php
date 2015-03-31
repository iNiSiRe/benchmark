<?php

namespace Benchmark;

use BenchmarkSuite\Benchmark;
use Test\ArrayTest;
use Test\ObjectTest;

class ArrayObjectBenchmark
{
    public function run($config = [])
    {
        $benchmark = new Benchmark();

        $config = ['iterations' => 10000, 'size' => 25];

        $tests = [
            new ArrayTest($config),
            new ObjectTest($config)
        ];

        foreach ($tests as $test) {
            list ($time, $memory, $result) = $benchmark->run($test);
            echo sprintf('%s %10.4f s %10.2f kb', $config['iterations'], $time, $memory) . PHP_EOL;
        }
    }
}