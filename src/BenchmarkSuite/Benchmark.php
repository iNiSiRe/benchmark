<?php

namespace BenchmarkSuite;

class Benchmark
{
    public function run(Test $test)
    {
        $time = microtime(true);
        $memory = memory_get_usage(true);

        $result = $test->execute();

        return [
            microtime(true) - $time,
            (memory_get_usage(true) - $memory) / 1024,
            $result
        ];
    }
}