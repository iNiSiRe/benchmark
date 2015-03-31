<?php

namespace Test;

use BenchmarkSuite\Test;

class TestObject
{

}

class PdoFetchObjectTest extends Test
{
    public function execute()
    {
        /** @var \PDO $connection */
        $connection = $this->getConfiguration('connection');
        $statement = $connection->query('SELECT * FROM test');

        return $statement->fetchAll(\PDO::FETCH_CLASS, 'Test\TestObject');
    }
}