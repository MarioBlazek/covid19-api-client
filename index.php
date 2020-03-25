<?php

require_once __DIR__ . '/vendor/autoload.php';

$filesystemAdapter = new \Symfony\Component\Cache\Adapter\FilesystemAdapter();
$cacheHandler = new \Marek\Covid19\Core\Cache\SymfonyCache($filesystemAdapter);

$factory = new \Marek\Covid19\Core\Factory\ConsumerFactory($cacheHandler);

$consumer = $factory->createAPIConsumer();

/** @var \Marek\Covid19\API\Value\Response\Summary $summary */
//$summary = $consumer->getSummary();


$country = new \Marek\Covid19\API\Value\Parameter\Country('spain');
$status = new \Marek\Covid19\API\Value\Parameter\Status(
    \Marek\Covid19\API\Constraints\Cases::DEATHS
);

//$res = $consumer->getDayOne($country, $status);

$res = $consumer->getCountries();
dump($res);
