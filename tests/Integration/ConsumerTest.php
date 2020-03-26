<?php

namespace Marek\Covid19\Tests\Integration;

use Marek\Covid19\API\Cache\HandlerInterface;
use Marek\Covid19\API\Constraints\Cases;
use Marek\Covid19\API\Constraints\Countries;
use Marek\Covid19\API\Http\Client\HttpClientInterface;
use Marek\Covid19\API\Value\Parameter\Country;
use Marek\Covid19\API\Value\Parameter\DateAndTime;
use Marek\Covid19\API\Value\Parameter\Status;
use Marek\Covid19\Core\Factory\DenormalizerFactory;
use Marek\Covid19\Core\Factory\UrlFactory;
use Marek\Covid19\Core\Http\Response\JsonResponse;
use Marek\Covid19\Core\Service\Consumer;
use PHPUnit\Framework\TestCase;

class ConsumerTest extends TestCase
{
    protected $consumer;

    protected $httpClient;

    protected $cacheHandler;

    public function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        $this->cacheHandler = $this->createMock(HandlerInterface::class);

        $this->consumer = new Consumer(
            $this->httpClient,
            new UrlFactory(),
            $this->cacheHandler,
            (new DenormalizerFactory())->create()
        );
    }
    public function testSummary()
    {
        $this->cacheHandler->expects($this->once())
            ->method('has')
            ->with('https://api.covid19api.com/summary')
            ->willReturn(false);

        $json = file_get_contents(__DIR__ . '/summary.json');

        $response = new JsonResponse($json, 200);

        $this->httpClient->expects($this->once())
            ->method('get')
            ->with('https://api.covid19api.com/summary')
            ->willReturn($response);

        $summary = $this->consumer->getSummary();

        $this->assertCount(2, $summary->getSummaries());

        $data = json_decode($json, true);

        $this->assertEquals($data['Countries'][0]['Country'], $summary->getSummaries()[0]->country);
        $this->assertEquals($data['Countries'][0]['Slug'], $summary->getSummaries()[0]->slug);
        $this->assertEquals($data['Countries'][0]['NewConfirmed'], $summary->getSummaries()[0]->newConfirmed);
        $this->assertEquals($data['Countries'][0]['TotalConfirmed'], $summary->getSummaries()[0]->totalConfirmed);
        $this->assertEquals($data['Countries'][0]['NewDeaths'], $summary->getSummaries()[0]->newDeaths);
        $this->assertEquals($data['Countries'][0]['TotalDeaths'], $summary->getSummaries()[0]->totalDeaths);
        $this->assertEquals($data['Countries'][0]['NewRecovered'], $summary->getSummaries()[0]->newDeaths);
        $this->assertEquals($data['Countries'][0]['TotalRecovered'], $summary->getSummaries()[0]->totalRecovered);

        $this->assertEquals($data['Countries'][1]['Country'], $summary->getSummaries()[1]->country);
        $this->assertEquals($data['Countries'][1]['Slug'], $summary->getSummaries()[1]->slug);
        $this->assertEquals($data['Countries'][1]['NewConfirmed'], $summary->getSummaries()[1]->newConfirmed);
        $this->assertEquals($data['Countries'][1]['TotalConfirmed'], $summary->getSummaries()[1]->totalConfirmed);
        $this->assertEquals($data['Countries'][1]['NewDeaths'], $summary->getSummaries()[1]->newDeaths);
        $this->assertEquals($data['Countries'][1]['TotalDeaths'], $summary->getSummaries()[1]->totalDeaths);
        $this->assertEquals($data['Countries'][1]['NewRecovered'], $summary->getSummaries()[1]->newDeaths);
        $this->assertEquals($data['Countries'][1]['TotalRecovered'], $summary->getSummaries()[1]->totalRecovered);
    }

    public function testCountries()
    {
        $this->cacheHandler->expects($this->once())
            ->method('has')
            ->with('https://api.covid19api.com/countries')
            ->willReturn(false);

        $json = file_get_contents(__DIR__ . '/countries.json');

        $response = new JsonResponse($json, 200);

        $this->httpClient->expects($this->once())
            ->method('get')
            ->with('https://api.covid19api.com/countries')
            ->willReturn($response);

        $countries = $this->consumer->getCountries();

        $this->assertCount(2, $countries->getCountries());

        $data = json_decode($json, true);

        $this->assertEquals($data[0]['Country'], $countries->getCountries()[0]->country);
        $this->assertEquals($data[0]['Slug'], $countries->getCountries()[0]->slug);
        $this->assertEquals($data[0]['Provinces'], $countries->getCountries()[0]->provinces);

        $this->assertEquals($data[1]['Country'], $countries->getCountries()[1]->country);
        $this->assertEquals($data[1]['Slug'], $countries->getCountries()[1]->slug);
        $this->assertEquals($data[1]['Provinces'], $countries->getCountries()[1]->provinces);
    }

    public function testStatistics()
    {
        $this->cacheHandler->expects($this->once())
            ->method('has')
            ->with('https://api.covid19api.com/stats')
            ->willReturn(false);

        $json = file_get_contents(__DIR__ . '/statistics.json');

        $response = new JsonResponse($json, 200);

        $this->httpClient->expects($this->once())
            ->method('get')
            ->with('https://api.covid19api.com/stats')
            ->willReturn($response);

        $statistics = $this->consumer->getStatistics();;

        $data = json_decode($json, true);

        $this->assertEquals($data['Total'], $statistics->total);
        $this->assertEquals($data['All'], $statistics->all);
        $this->assertEquals($data['AllUpdated'], $statistics->allUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['Countries'], $statistics->countries);
        $this->assertEquals($data['CountriesUpdated'], $statistics->countriesUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['ByCountry'], $statistics->byCountry);
        $this->assertEquals($data['ByCountryUpdated'], $statistics->byCountryUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['ByCountryLive'], $statistics->byCountryLive);
        $this->assertEquals($data['ByCountryLiveUpdated'], $statistics->byCountryLiveUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['ByCountryTotal'], $statistics->byCountryTotal);
        $this->assertEquals($data['ByCountryTotalUpdated'], $statistics->byCountryTotalUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['DayOne'], $statistics->dayOne);
        $this->assertEquals($data['DayOneUpdated'], $statistics->dayOneUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['DayOneLive'], $statistics->dayOneLive);
        $this->assertEquals($data['DayOneLiveUpdated'], $statistics->dayOneLiveUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['DayOneTotal'], $statistics->dayOneTotal);
        $this->assertEquals($data['DayOneTotalUpdated'], $statistics->dayOneTotalUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['LiveCountryStatus'], $statistics->liveCountryStatus);
        $this->assertEquals($data['LiveCountryStatusUpdated'], $statistics->liveCountryStatusUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['LiveCountryStatusAfterDate'], $statistics->liveCountryStatusAfterDate);
        $this->assertEquals($data['LiveCountryStatusAfterDateUpdated'], $statistics->liveCountryStatusAfterDateUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['Stats'], $statistics->statistics);
        $this->assertEquals($data['StatsUpdated'], $statistics->statisticsUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['Default'], $statistics->default);
        $this->assertEquals($data['DefaultUpdated'], $statistics->defaultUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['SubmitWebhook'], $statistics->submitWebhook);
        $this->assertEquals($data['SubmitWebhookUpdated'], $statistics->submitWebhookUpdated->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data['Summary'], $statistics->summary);
        $this->assertEquals($data['SummaryUpdated'], $statistics->summaryUpdated->format('Y-m-d\TH:i:s\Z'));
    }

    /**
     * @dataProvider reports
     */
    public function testReports($url, $method)
    {
        $this->cacheHandler->expects($this->once())
            ->method('has')
            ->with($url)
            ->willReturn(false);

        $json = file_get_contents(__DIR__ . '/reports.json');

        $response = new JsonResponse($json, 200);

        $this->httpClient->expects($this->once())
            ->method('get')
            ->with($url)
            ->willReturn($response);

        $country = new Country(Countries::COUNTRY_UNITED_KINGDOM);
        $status = new Status(Cases::CONFIRMED);

        $report = $this->consumer->$method($country, $status);

        $data = json_decode($json, true);

        $this->assertCount(1, $report->getReports());

        $this->assertEquals($data[0]['Country'], $report->getReports()[0]->country);
        $this->assertEquals($data[0]['Province'], $report->getReports()[0]->province);
        $this->assertEquals($data[0]['Lat'], $report->getReports()[0]->latitude);
        $this->assertEquals($data[0]['Lon'], $report->getReports()[0]->longitude);
        $this->assertEquals($data[0]['Date'], $report->getReports()[0]->date->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data[0]['Cases'], $report->getReports()[0]->cases);
        $this->assertEquals($data[0]['Status'], $report->getReports()[0]->status);
    }

    public function reports(): array
    {
        return [
            [
                'https://api.covid19api.com/dayone/country/united-kingdom/status/confirmed',
                'getDayOne',
            ],
            [
                'https://api.covid19api.com/dayone/country/united-kingdom/status/confirmed/live',
                'getDayOneLive',
            ],
            [
                'https://api.covid19api.com/total/dayone/country/united-kingdom/status/confirmed',
                'getDayOneTotal',
            ],
            [
                'https://api.covid19api.com/country/united-kingdom/status/confirmed',
                'getByCountry',
            ],
            [
                'https://api.covid19api.com/country/united-kingdom/status/confirmed/confirmed',
                'getByCountryLive',
            ],
            [
                'https://api.covid19api.com/total/country/united-kingdom/status/confirmed',
                'getByCountryTotal',
            ],
            [
                'https://api.covid19api.com/live/country/united-kingdom/status/confirmed',
                'getLiveByCountryAndStatus',
            ],
        ];
    }

    public function testGetLiveByCountryAndStatusAfterDate()
    {
        $dateTime = new \DateTimeImmutable('now');
        $url = 'https://api.covid19api.com/live/country/united-kingdom/status/confirmed/date/' . $dateTime->format('Y-m-d\TH:i:s\Z');

        $this->cacheHandler->expects($this->once())
            ->method('has')
            ->with($url)
            ->willReturn(false);

        $json = file_get_contents(__DIR__ . '/reports.json');

        $response = new JsonResponse($json, 200);

        $this->httpClient->expects($this->once())
            ->method('get')
            ->with($url)
            ->willReturn($response);

        $country = new Country(Countries::COUNTRY_UNITED_KINGDOM);
        $status = new Status(Cases::CONFIRMED);
        $date = new DateAndTime(new \DateTimeImmutable('now'));

        $report = $this->consumer->getLiveByCountryAndStatusAfterDate($country, $status, $date);

        $data = json_decode($json, true);

        $this->assertCount(1, $report->getReports());

        $this->assertEquals($data[0]['Country'], $report->getReports()[0]->country);
        $this->assertEquals($data[0]['Province'], $report->getReports()[0]->province);
        $this->assertEquals($data[0]['Lat'], $report->getReports()[0]->latitude);
        $this->assertEquals($data[0]['Lon'], $report->getReports()[0]->longitude);
        $this->assertEquals($data[0]['Date'], $report->getReports()[0]->date->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data[0]['Cases'], $report->getReports()[0]->cases);
        $this->assertEquals($data[0]['Status'], $report->getReports()[0]->status);
    }

    public function testGetAllData()
    {
        $url = 'https://api.covid19api.com/all';

        $this->cacheHandler->expects($this->once())
            ->method('has')
            ->with($url)
            ->willReturn(false);

        $json = file_get_contents(__DIR__ . '/reports.json');

        $response = new JsonResponse($json, 200);

        $this->httpClient->expects($this->once())
            ->method('get')
            ->with($url)
            ->willReturn($response);

        $report = $this->consumer->getAllData();

        $data = json_decode($json, true);

        $this->assertCount(1, $report->getReports());

        $this->assertEquals($data[0]['Country'], $report->getReports()[0]->country);
        $this->assertEquals($data[0]['Province'], $report->getReports()[0]->province);
        $this->assertEquals($data[0]['Lat'], $report->getReports()[0]->latitude);
        $this->assertEquals($data[0]['Lon'], $report->getReports()[0]->longitude);
        $this->assertEquals($data[0]['Date'], $report->getReports()[0]->date->format('Y-m-d\TH:i:s\Z'));
        $this->assertEquals($data[0]['Cases'], $report->getReports()[0]->cases);
        $this->assertEquals($data[0]['Status'], $report->getReports()[0]->status);
    }
}
