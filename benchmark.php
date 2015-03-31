<?php

require __DIR__ . '/vendor/autoload.php';

$benchmark = new \Benchmark\DatabaseBenchmark();
$benchmark->run();