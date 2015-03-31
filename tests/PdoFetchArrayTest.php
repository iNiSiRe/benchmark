<?php

namespace Test;

use BenchmarkSuite\Test;

class PdoFetchArrayTest extends Test
{
    public function execute()
    {
        /** @var \PDO $connection */
        $connection = $this->getConfiguration('connection');
        $statement = $connection->query('SELECT * FROM test');

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}