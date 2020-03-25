<?php

namespace Marek\Covid19\Core\Service;

use Marek\Covid19\API\Cache\HandlerInterface;
use Marek\Covid19\API\Http\Client\HttpClientInterface;
use Marek\Covid19\API\Service\Endpoints;
use Marek\Covid19\API\Value\Parameter\Country;
use Marek\Covid19\API\Value\Parameter\DateAndTime;
use Marek\Covid19\API\Value\Parameter\Status;
use Marek\Covid19\API\Value\Response\AllData;
use Marek\Covid19\API\Value\Response\Countries;
use Marek\Covid19\API\Value\Response\Report;
use Marek\Covid19\API\Value\Response\Statistics;
use Marek\Covid19\API\Value\Response\Summary;
use Marek\Covid19\Core\Factory\UrlFactory;
use Marek\Covid19\Denormalizer\DenormalizerInterface;

final class Consumer implements Endpoints
{
    private const URL_SUMMARY = 'https://api.covid19api.com/summary';
    private const URL_COUNTRIES = 'https://api.covid19api.com/countries';
    private const URL_DAY_ONE = 'https://api.covid19api.com/dayone/country/{country}/status/{case}';
    private const URL_DAY_ONE_LIVE = 'https://api.covid19api.com/dayone/country/{country}/status/{case}/live';
    private const URL_DAY_ONE_TOTAL = 'https://api.covid19api.com/total/dayone/country/{country}/status/{case}';
    private const URL_BY_COUNTRY = 'https://api.covid19api.com/country/{country}/status/{case}';
    private const URL_BY_COUNTRY_LIVE = 'https://api.covid19api.com/country/{country}/status/confirmed/{case}';
    private const URL_BY_COUNTRY_TOTAL = 'https://api.covid19api.com/total/country/{country}/status/{case}';
    private const URL_LIVE_BY_COUNTRY_AND_STATUS = 'https://api.covid19api.com/live/country/{country}/status/{case}';
    private const URL_LIVE_BY_COUNTRY_AND_STATUS_AFTER_DATE = 'https://api.covid19api.com/live/country/{country}/status/{case}/date/{date_and_time}';
    private const URL_ALL_DATA = 'https://api.covid19api.com/all';
    private const URL_STATS = 'https://api.covid19api.com/stats';

    /**
     * @var \Marek\Covid19\API\Http\Client\HttpClientInterface
     */
    private $client;

    /**
     * @var \Marek\Covid19\Core\Factory\UrlFactory
     */
    private $factory;

    /**
     * @var \Marek\Covid19\API\Cache\HandlerInterface
     */
    private $handler;

    /**
     * @var \Marek\Covid19\Denormalizer\DenormalizerInterface
     */
    private $denormalizer;

    public function __construct(HttpClientInterface $client, UrlFactory $factory, HandlerInterface $handler, DenormalizerInterface $denormalizer)
    {
        $this->client = $client;
        $this->factory = $factory;
        $this->handler = $handler;
        $this->denormalizer = $denormalizer;
    }

    public function getSummary(): Summary
    {
        $params = $this->factory->buildBag(self::URL_SUMMARY);

        $result = $this->getResult($params->getUrl());

        return $this->denormalizer->denormalize($result, new Summary());
    }

    public function getCountries(): Countries
    {
        $params = $this->factory->buildBag(self::URL_COUNTRIES);

        $result = $this->getResult($params->getUrl());

        return $this->denormalizer->denormalize($result, new Countries());
    }

    public function getDayOne(Country $country, Status $status): Report
    {
        $params = $this->factory->buildBag(self::URL_DAY_ONE);
        $params->setUriParameter($country);
        $params->setUriParameter($status);

        $result = $this->getResult($this->factory->build($params));

        return $this->denormalizer->denormalize($result, new Report());
    }

    public function getDayOneLive(Country $country, Status $status): Report
    {
        $params = $this->factory->buildBag(self::URL_DAY_ONE_LIVE);
        $params->setUriParameter($country);
        $params->setUriParameter($status);

        $result = $this->getResult($this->factory->build($params));

        return new Report([]);
    }

    public function getDayOneTotal(Country $country, Status $status): Report
    {
        $params = $this->factory->buildBag(self::URL_DAY_ONE_TOTAL);
        $params->setUriParameter($country);
        $params->setUriParameter($status);

        $result = $this->getResult($this->factory->build($params));

        return new Report([]);
    }

    public function getByCountry(Country $country, Status $status): Report
    {
        $params = $this->factory->buildBag(self::URL_BY_COUNTRY);
        $params->setUriParameter($country);
        $params->setUriParameter($status);

        $result = $this->getResult($this->factory->build($params));

        return new Report([]);
    }

    public function getByCountryLive(Country $country, Status $status): Report
    {
        $params = $this->factory->buildBag(self::URL_BY_COUNTRY_LIVE);
        $params->setUriParameter($country);
        $params->setUriParameter($status);

        $result = $this->getResult($this->factory->build($params));

        return new Report([]);
    }

    public function getCountryTotal(Country $country, Status $status): Report
    {
        $params = $this->factory->buildBag(self::URL_BY_COUNTRY_TOTAL);
        $params->setUriParameter($country);
        $params->setUriParameter($status);

        $result = $this->getResult($this->factory->build($params));

        return new Report([]);
    }

    public function getLiveByCountryAndStatus(Country $country, Status $status): Report
    {
        $params = $this->factory->buildBag(self::URL_LIVE_BY_COUNTRY_AND_STATUS);
        $params->setUriParameter($country);
        $params->setUriParameter($status);

        $result = $this->getResult($this->factory->build($params));

        return new Report([]);
    }

    public function getLiveByCountryAndStatusAfterDate(Country $country, Status $status, DateAndTime $date): Report
    {
        $params = $this->factory->buildBag(self::URL_LIVE_BY_COUNTRY_AND_STATUS_AFTER_DATE);
        $params->setUriParameter($country);
        $params->setUriParameter($status);
        $params->setUriParameter($date);

        $result = $this->getResult($this->factory->build($params));

        return new Report([]);
    }

    public function getAllData(): AllData
    {
        $params = $this->factory->buildBag(self::URL_ALL_DATA);

        $result = $this->getResult($this->factory->build($params));

        return new AllData([]);
    }

    public function getStats(): Statistics
    {
        $params = $this->factory->buildBag(self::URL_STATS);

        $result = $this->getResult($this->factory->build($params));

        return new Statistics([]);
    }

    protected function getResult(string $url): array
    {
        if ($this->handler->has($url)) {
            return $this->handler->get($url);
        }

        $response = $this->client->get($url);

//        ExceptionThrower::throwException($response->getStatusCode(), $response->getMessage());

        return $response->getData();
    }
}
