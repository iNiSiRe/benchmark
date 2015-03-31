<?php

namespace Test;

use BenchmarkSuite\Test;

class ArrayTest extends Test
{
    private function createElement($propertiesCount)
    {
        $element = [];
        for ($i = 0; $i < $propertiesCount; $i++) {
            $element['property' . $i] = 'data' . $i;
        }

        return $element;
    }

    public function execute()
    {
        $iterations = $this->getConfiguration('iterations', 0);
        $size = $this->getConfiguration('size', 0);

        $result = [];
        for ($i = 0; $i < $iterations; $i++) {
            $result[] = $this->createElement($size);
        }

        return $result;
    }
}