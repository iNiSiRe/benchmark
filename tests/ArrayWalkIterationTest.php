<?php
/**
 * Created by PhpStorm.
 * User: inisire
 * Date: 29.01.16
 * Time: 12:09
 */

namespace Test;


use BenchmarkSuite\Test;

class ArrayWalkIterationTest extends Test
{
    public function execute()
    {
        $array = $this->getConfiguration('array', []);

        $count = count($array);
        $sum = 0;

        array_walk($array, function ($item) use (&$sum) {
            $sum += (int) $item;
        });

        return $sum / $count;
    }
}