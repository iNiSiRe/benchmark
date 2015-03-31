<?php

namespace Test;

use BenchmarkSuite\Test;

class PdoPreparedInsertTest extends Test
{
    public function execute()
    {
        /** @var \PDO $connection */
        $connection = $this->getConfiguration('connection');

        $statement = $connection->prepare("INSERT INTO test (`key`, `value`) VALUES (:key, :value)");
        for ($i = 0; $i < 100; $i++) {
            $key = md5($i . time());
            $value = md5($key . time());
            $statement->bindValue(':key' , $key);
            $statement->bindValue(':value' , $value);
            $statement->execute();
        }

        return true;
    }
}