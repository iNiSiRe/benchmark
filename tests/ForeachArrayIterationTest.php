<?php
/**
 * Created by PhpStorm.
 * User: inisire
 * Date: 29.01.16
 * Time: 12:09
 */

namespace Test;


use BenchmarkSuite\Test;

class ForeachArrayIterationTest extends Test
{
    public function execute()
    {
        $array = $this->getConfiguration('array', []);

        $count = count($array);
        $sum = 0;

        foreach ($array as $item) {
            $sum += (int) $item;
        }

        return $sum / $count;
    }
}