<?php
/**
 * Created by PhpStorm.
 * User: inisire
 * Date: 29.01.16
 * Time: 12:16
 */

namespace Benchmark;

use BenchmarkSuite\Benchmark;
use Test\ArrayWalkIterationTest;
use Test\ForeachArrayIterationTest;

class WalkVsForeachBenchmark
{
    public function run($config = [])
    {
        $benchmark = new Benchmark();

        $array = [];
        for ($i = 0; $i < 100000; $i++) {
            $array[] = rand(0, 100);
        }

        $config = [
            'array' => $array,
            'iterations' => 100000
        ];

        $tests = [
            new ArrayWalkIterationTest($config),
            new ForeachArrayIterationTest($config)
        ];

        foreach ($tests as $test) {
            list ($time, $memory, $result) = $benchmark->run($test);
            echo sprintf('%30s - %s %10.4f s %10.2f kb', get_class($test), $config['iterations'], $time, $memory) . PHP_EOL;
        }
    }
}