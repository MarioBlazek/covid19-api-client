Documentation
=============

API documentation for Coronavirus COVID19 API can be found [here](https://documenter.getpostman.com/view/10808728/SzS8rjbc?version=latest).

## Bootstrap

Before using API consumer we need to configure the cache handler. Libray comes with cache handler for the [Symfony Cache](https://symfony.com/doc/current/components/cache.html) component. It support all available cache [adapters](https://symfony.com/doc/current/components/cache.html#available-cache-adapters) from Symfony. [ConsumerFactory](../lib/Core/Factory/ConsumerFactory.php) is a nice shorthand to create an API consumer.

```php
require_once __DIR__ . '/vendor/autoload.php';

$filesystemAdapter = new \Symfony\Component\Cache\Adapter\FilesystemAdapter();
$cacheHandler = new \Marek\Covid19\Core\Cache\SymfonyCache(
    $filesystemAdapter,
    \Marek\Covid19\API\Constraints\TimeToLive::TTL_NONE
);

$factory = new \Marek\Covid19\Core\Factory\ConsumerFactory($cacheHandler);

/** @var \Marek\Covid19\API\Service\Endpoints $consumer */
$consumer = $factory->createAPIConsumer();
```

## Summary

A summary of new and total cases per country updated daily.

```php
/** @var \Marek\Covid19\API\Value\Response\Summary $summary */
$summary = $consumer->getSummary();

foreach ($summary->getSummaries() as $entry) {
    echo $entry->country . PHP_EOL;
    echo $entry->slug . PHP_EOL;
    echo $entry->newConfirmed . PHP_EOL;
    echo $entry->totalConfirmed . PHP_EOL;
    echo $entry->newDeaths . PHP_EOL;
    echo $entry->totalDeaths . PHP_EOL;
    echo $entry->newRecovered . PHP_EOL;
    echo $entry->totalRecovered . PHP_EOL;
}
```

## Countries

Returns all the available countries and provinces, as well as the country slug for per country requests.

```php
/** @var \Marek\Covid19\API\Value\Response\Countries $countries */
$countries = $consumer->getCountries();

foreach ($countries->getCountries() as $entry) {
    echo $entry->country . PHP_EOL;
    echo $entry->slug . PHP_EOL;
    echo $entry->provinces . PHP_EOL;
}
```

## All Data

Returns all daily data. This call results in 10MB of data being returned and should be used infrequently.

```php
/** @var \Marek\Covid19\API\Value\Response\AllData $allData */
$allData = $consumer->getAllData();

foreach ($allData->getReports() as $entry) {
    echo $entry->country . PHP_EOL;
    echo $entry->province . PHP_EOL;
    echo $entry->latitude . PHP_EOL;
    echo $entry->longitude . PHP_EOL;
    echo $entry->date->format('m-d-Y') . PHP_EOL;
    echo $entry->cases . PHP_EOL;
    echo $entry->status . PHP_EOL;
}
```

## Stats

Complete list of statistics.

```php
/** @var \Marek\Covid19\API\Value\Response\Statistics $statistics */
$statistics = $consumer->getStatistics();

echo $statistics->total . PHP_EOL;
echo $statistics->all . PHP_EOL;
echo $statistics->allUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->countries . PHP_EOL;
echo $statistics->countriesUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->byCountry . PHP_EOL;
echo $statistics->byCountryUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->byCountryLive . PHP_EOL;
echo $statistics->byCountryLiveUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->byCountryTotal . PHP_EOL;
echo $statistics->byCountryTotalUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->dayOne . PHP_EOL;
echo $statistics->dayOneUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->dayOneLive . PHP_EOL;
echo $statistics->dayOneLiveUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->dayOneTotal . PHP_EOL;
echo $statistics->dayOneTotalUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->liveCountryStatus . PHP_EOL;
echo $statistics->liveCountryStatusUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->liveCountryStatusAfterDate . PHP_EOL;
echo $statistics->liveCountryStatusAfterDateUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->statistics . PHP_EOL;
echo $statistics->statisticsUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->default . PHP_EOL;
echo $statistics->defaultUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->submitWebhook . PHP_EOL;
echo $statistics->submitWebhookUpdated->format('m-d-Y') . PHP_EOL;
echo $statistics->summary . PHP_EOL;
echo $statistics->summaryUpdated->format('m-d-Y') . PHP_EOL;
```

## Day One

Returns all cases by case type for a country from the first recorded case. Country must be the Slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.

```php
$country = new \Marek\Covid19\API\Value\Parameter\Country(
    \Marek\Covid19\API\Constraints\Countries::COUNTRY_AUSTRALIA
);
$status = new \Marek\Covid19\API\Value\Parameter\Status(
    \Marek\Covid19\API\Constraints\Cases::DEATHS
);

/** @var \Marek\Covid19\API\Value\Response\Report $report */
$report = $consumer->getDayOne($country, $status);

foreach ($report->getReports() as $entry) {
    echo $entry->country . PHP_EOL;
    echo $entry->province . PHP_EOL;
    echo $entry->latitude . PHP_EOL;
    echo $entry->longitude . PHP_EOL;
    echo $entry->date->format('m-d-Y') . PHP_EOL;
    echo $entry->cases . PHP_EOL;
    echo $entry->status . PHP_EOL;
}
```

## Day One Live

Returns all cases by case type for a country from the first recorded case with the latest record being the live count. Country must be the Slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.

```php
$country = new \Marek\Covid19\API\Value\Parameter\Country(
    \Marek\Covid19\API\Constraints\Countries::COUNTRY_AUSTRALIA
);
$status = new \Marek\Covid19\API\Value\Parameter\Status(
    \Marek\Covid19\API\Constraints\Cases::DEATHS
);

/** @var \Marek\Covid19\API\Value\Response\Report $report */
$report = $consumer->getDayOneLive($country, $status);

foreach ($report->getReports() as $entry) {
    echo $entry->country . PHP_EOL;
    echo $entry->province . PHP_EOL;
    echo $entry->latitude . PHP_EOL;
    echo $entry->longitude . PHP_EOL;
    echo $entry->date->format('m-d-Y') . PHP_EOL;
    echo $entry->cases . PHP_EOL;
    echo $entry->status . PHP_EOL;
}
```

## Day One Total

Returns all cases by case type for a country from the first recorded case. Country must be the slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.

```php
$country = new \Marek\Covid19\API\Value\Parameter\Country(
    \Marek\Covid19\API\Constraints\Countries::COUNTRY_AUSTRALIA
);
$status = new \Marek\Covid19\API\Value\Parameter\Status(
    \Marek\Covid19\API\Constraints\Cases::DEATHS
);

/** @var \Marek\Covid19\API\Value\Response\Report $report */
$report = $consumer->getDayOneTotal($country, $status);

foreach ($report->getReports() as $entry) {
    echo $entry->country . PHP_EOL;
    echo $entry->province . PHP_EOL;
    echo $entry->latitude . PHP_EOL;
    echo $entry->longitude . PHP_EOL;
    echo $entry->date->format('m-d-Y') . PHP_EOL;
    echo $entry->cases . PHP_EOL;
    echo $entry->status . PHP_EOL;
}
```

## By Country

Returns all cases by case type for a country. Country must be the slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.

```php
$country = new \Marek\Covid19\API\Value\Parameter\Country(
    \Marek\Covid19\API\Constraints\Countries::COUNTRY_AUSTRALIA
);
$status = new \Marek\Covid19\API\Value\Parameter\Status(
    \Marek\Covid19\API\Constraints\Cases::CONFIRMED
);

/** @var \Marek\Covid19\API\Value\Response\Report $report */
$report = $consumer->getByCountry($country, $status);

foreach ($report->getReports() as $entry) {
    echo $entry->country . PHP_EOL;
    echo $entry->province . PHP_EOL;
    echo $entry->latitude . PHP_EOL;
    echo $entry->longitude . PHP_EOL;
    echo $entry->date->format('m-d-Y') . PHP_EOL;
    echo $entry->cases . PHP_EOL;
    echo $entry->status . PHP_EOL;
}
```

## By Country Live

Returns all cases by case type for a country from the first recorded case with the latest record being the live count. Country must be the Slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths

```php
$country = new \Marek\Covid19\API\Value\Parameter\Country(
    \Marek\Covid19\API\Constraints\Countries::COUNTRY_AUSTRALIA
);
$status = new \Marek\Covid19\API\Value\Parameter\Status(
    \Marek\Covid19\API\Constraints\Cases::RECOVERED
);

/** @var \Marek\Covid19\API\Value\Response\Report $report */
$report = $consumer->getByCountryLive($country, $status);

foreach ($report->getReports() as $entry) {
    echo $entry->country . PHP_EOL;
    echo $entry->province . PHP_EOL;
    echo $entry->latitude . PHP_EOL;
    echo $entry->longitude . PHP_EOL;
    echo $entry->date->format('m-d-Y') . PHP_EOL;
    echo $entry->cases . PHP_EOL;
    echo $entry->status . PHP_EOL;
}
```

## By Country Total

Returns all cases by case type for a country. Country must be the slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.

```php
$country = new \Marek\Covid19\API\Value\Parameter\Country(
    \Marek\Covid19\API\Constraints\Countries::COUNTRY_AUSTRALIA
);
$status = new \Marek\Covid19\API\Value\Parameter\Status(
    \Marek\Covid19\API\Constraints\Cases::DEATHS
);

/** @var \Marek\Covid19\API\Value\Response\Report $report */
$report = $consumer->getByCountryTotal($country, $status);

foreach ($report->getReports() as $entry) {
    echo $entry->country . PHP_EOL;
    echo $entry->province . PHP_EOL;
    echo $entry->latitude . PHP_EOL;
    echo $entry->longitude . PHP_EOL;
    echo $entry->date->format('m-d-Y') . PHP_EOL;
    echo $entry->cases . PHP_EOL;
    echo $entry->status . PHP_EOL;
}
```

## Live By Country And Status

Returns all live cases by case type for a country. These records are pulled every 10 minutes and are ungrouped. Country must be the slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.

```php
$country = new \Marek\Covid19\API\Value\Parameter\Country(
    \Marek\Covid19\API\Constraints\Countries::COUNTRY_AUSTRALIA
);
$status = new \Marek\Covid19\API\Value\Parameter\Status(
    \Marek\Covid19\API\Constraints\Cases::DEATHS
);

/** @var \Marek\Covid19\API\Value\Response\Report $report */
$report = $consumer->getLiveByCountryAndStatus($country, $status);

foreach ($report->getReports() as $entry) {
    echo $entry->country . PHP_EOL;
    echo $entry->province . PHP_EOL;
    echo $entry->latitude . PHP_EOL;
    echo $entry->longitude . PHP_EOL;
    echo $entry->date->format('m-d-Y') . PHP_EOL;
    echo $entry->cases . PHP_EOL;
    echo $entry->status . PHP_EOL;
}
```

## Live By Country And Status After Date

Returns all live cases by case type for a country after a given date. These records are pulled every 10 minutes and are ungrouped. Country must be the slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.

```php
$country = new \Marek\Covid19\API\Value\Parameter\Country(
    \Marek\Covid19\API\Constraints\Countries::COUNTRY_AUSTRALIA
);
$status = new \Marek\Covid19\API\Value\Parameter\Status(
    \Marek\Covid19\API\Constraints\Cases::DEATHS
);
$date = new \Marek\Covid19\API\Value\Parameter\DateAndTime(
    new \DateTimeImmutable('1 month ago')
);

/** @var \Marek\Covid19\API\Value\Response\Report $report */
$report = $consumer->getLiveByCountryAndStatusAfterDate($country, $status, $date);

foreach ($report->getReports() as $entry) {
    echo $entry->country . PHP_EOL;
    echo $entry->province . PHP_EOL;
    echo $entry->latitude . PHP_EOL;
    echo $entry->longitude . PHP_EOL;
    echo $entry->date->format('m-d-Y') . PHP_EOL;
    echo $entry->cases . PHP_EOL;
    echo $entry->status . PHP_EOL;
}
```
