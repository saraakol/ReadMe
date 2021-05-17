<?php namespace App\Libraries;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;


class Doctrine
{
    public $em = null;

  
    public function __construct()
    {
        $dbConfig = config('Config\Database');
        $db = $dbConfig->{$dbConfig->defaultGroup};
        
        $isDevMode = ENVIRONMENT !== 'production';

        $entityDir = APPPATH . 'Models'.DIRECTORY_SEPARATOR.'Entities';
        $proxyDir = APPPATH . 'Models'.DIRECTORY_SEPARATOR.'Proxies'; 
        
        if (ENVIRONMENT !== 'production') {
            $cache = new \Doctrine\Common\Cache\ArrayCache;   
        } else {
            $cache = new \Doctrine\Common\Cache\ApcCache;
        } 
        
        $useSimpleAnnotationReader = false;
        $config = Setup::createAnnotationMetadataConfiguration(
            [$entityDir],
            $isDevMode,
            $proxyDir,
            null,
            $useSimpleAnnotationReader
        );
        
        $config->setProxyNamespace('App\Models\Proxies');


        $connection = [
            'driver'   => $db['DBDriver'] === 'MySQLi' ? 'mysqli' : 'pdo_mysql',
            'user'     => $db['username'],
            'password' => $db['password'],
            'host'     => $db['hostname'],
            'dbname'   => $db['database'],
            'charset'  => $db['charset'],
            'port'     => $db['port'],
        ];
                
        $this->em = EntityManager::create($connection, $config);
    }
} 