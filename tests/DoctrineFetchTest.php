<?php

namespace Test;

use BenchmarkSuite\Test;
use Doctrine\Common\Cache\MemcacheCache;
use Doctrine\Common\Cache\MemcachedCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Setup;

/**
 * Class TestEntity
 *
 * @package Test
 *
 * @Entity()
 * @Table(name="test")
 */
class TestEntity
{
    /**
     * @var int
     *
     * @Id()
     * @GeneratedValue()
     * @Column(type="integer", nullable=false)
     */
    public $id;

    /**
     * @var string
     *
     * @Column(type="string", length=255, nullable=false)
     */
    public $key;

    /**
     * @var string
     *
     * @Column(type="string", length=255, nullable=false)
     */
    public $value;
}

class DoctrineFetchTest extends Test
{
    public function __construct($config = [], $withMemcached = false)
    {
        parent::__construct($config);

        $paths = array("tests");
        $isDevMode = true;

        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'benchmark',
        );

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

        if ($withMemcached) {
            $memcached = new \Memcached();
            $memcached->addServer('localhost', 11211);
            $cache = new MemcachedCache();
            $cache->setMemcached($memcached);
            $config->setQueryCacheImpl($cache);
            $config->setMetadataCacheImpl($cache);
            $config->setResultCacheImpl($cache);
        }

        $this->entityManager = EntityManager::create($dbParams, $config);
    }

    public function execute()
    {
        if ($this->getConfiguration('repository')) {
            $tests = $this->entityManager->getRepository('Test\TestEntity')->findAll();
        } else {
            $hydrate = $this->getConfiguration('array') ? Query::HYDRATE_ARRAY : Query::HYDRATE_OBJECT;
            $tests = $this->entityManager->createQueryBuilder()->select('e')->from('Test\TestEntity', 'e')->getQuery()->getResult();
        }

        $this->entityManager->clear();

        return $tests;
    }
}