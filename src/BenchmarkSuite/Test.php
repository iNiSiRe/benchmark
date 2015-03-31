<?php

namespace BenchmarkSuite;

abstract class Test
{
    /**
     * @var array
     */
    private $configuration;

    /**
     * @param array $configuration
     */
    public function __construct($configuration = [])
    {
        $this->configuration = $configuration;
    }

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return array
     */
    public function getConfiguration($key, $default = null)
    {
        return isset($this->configuration[$key]) ? $this->configuration[$key] : $default;
    }

    abstract public function execute();
}