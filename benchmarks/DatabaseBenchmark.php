<?php

namespace Benchmark;

use BenchmarkSuite\Benchmark;
use Test\DoctrineFetchTest;
use Test\PdoFetchArrayTest;
use Test\PdoFetchObjectTest;
use Test\PdoFetchStdObjectTest;
use Test\PdoPreparedInsertTest;
use Test\PdoQueryInsertTest;

class DatabaseBenchmark
{
    public function run()
    {
        $config = [
            'host' => 'localhost',
            'database' => 'benchmark',
            'username' => 'root',
            'password' => ''
        ];

        $dsn = sprintf('mysql:host=%s;dbname=%s', $config['host'], $config['database']);
        $connection = new \PDO($dsn, $config['username'], $config['password']);
        $config['connection'] = $connection;

//        $fixture = new DatabaseFixture($config);
//        $fixture->up();

        $tests = [
            new DoctrineFetchTest(['repository' => true, 'array' => true], true),
            new DoctrineFetchTest(['repository' => true], true),
        ];

        $benchmark = new Benchmark();
        foreach ($tests as $test) {
            list ($time, $memory, $result) = $benchmark->run($test);
            echo sprintf('%30s %10.4f S %10.2f KB', get_class($test), $time, $memory) . PHP_EOL;
        }

        var_dump(count($result));
    }
}