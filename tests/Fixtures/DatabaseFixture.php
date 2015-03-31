<?php
/**
 * Created by PhpStorm.
 * User: inisire
 * Date: 19.03.15
 * Time: 16:57
 */

namespace Test\Fixtures;


class DatabaseFixture {

    public function __construct($config)
    {
        $this->connection = $config['connection'];
    }

    private function createTable()
    {
        return $this->connection->exec('CREATE TABLE test (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, `key` VARCHAR (255) NOT NULL, `value` VARCHAR (255) NOT NULL)');
    }

    private function dropTable()
    {
        return $this->connection->exec('DROP TABLE test');
    }

    private function fillTable()
    {
        $statement = $this->connection->prepare('INSERT INTO test (`key`, `value`) VALUES (:key, :value)');
        for ($i = 0; $i < 10000; $i++) {
            $statement->bindValue(':key', 'key' . $i);
            $statement->bindValue(':value', 'value' . $i);
            $statement->execute();
        }
    }

    private function checkError()
    {
        if ($error = $this->connection->errorInfo() && !empty($error)) {
            throw new \Exception($error[2], $error[1]);
        }
    }

    public function up()
    {
        if (!$this->createTable()) {
            $this->checkError();
        }

        $this->fillTable();
    }

    public function down()
    {
        if (!$this->dropTable()) {
            $this->checkError();
        }
    }
}