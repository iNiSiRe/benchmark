<?php

namespace Test;

use BenchmarkSuite\Test;

class PdoQueryInsertTest extends Test
{
    public function execute()
    {
        /** @var \PDO $connection */
        $connection = $this->getConfiguration('connection');

        for ($i = 0; $i < 100; $i++) {
            $key = md5($i . time());
            $value = md5($key . time());
            $connection->query("INSERT INTO test (`key`, `value`) VALUES ('$key', '$value')");
        }

        return true;
    }
}