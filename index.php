<?php

require_once __DIR__ . '/vendor/autoload.php';

$filesystemAdapter = new \Symfony\Component\Cache\Adapter\FilesystemAdapter();
$cacheHandler = new \Marek\Covid19\Core\Cache\SymfonyCache($filesystemAdapter);

$factory = new \Marek\Covid19\Core\Factory\ConsumerFactory($cacheHandler);

$consumer = $factory->createAPIConsumer();

$consumer->getSummary();
