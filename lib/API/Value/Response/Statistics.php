<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Value\Response;

class Statistics extends Response
{
    /**
     * @var int
     */
    public $total;

    /**
     * @var int
     */
    public $all;

    /**
     * @var \DateTimeImmutable
     */
    public $allUpdated;

    /**
     * @var int
     */
    public $countries;

    /**
     * @var \DateTimeImmutable
     */
    public $countriesUpdated;

    /**
     * @var int
     */
    public $byCountry;

    /**
     * @var \DateTimeImmutable
     */
    public $byCountryUpdated;

    /**
     * @var int
     */
    public $byCountryLive;

    /**
     * @var \DateTimeImmutable
     */
    public $byCountryLiveUpdated;

    /**
     * @var int
     */
    public $byCountryTotal;

    /**
     * @var \DateTimeImmutable
     */
    public $byCountryTotalUpdated;

    /**
     * @var
     */
    public $dayOne;

    /**
     * @var \DateTimeImmutable
     */
    public $dayOneUpdated;

    /**
     * @var int
     */
    public $dayOneLive;

    /**
     * @var \DateTimeImmutable
     */
    public $dayOneLiveUpdated;

    /**
     * @var int
     */
    public $dayOneTotal;

    /**
     * @var \DateTimeImmutable
     */
    public $dayOneTotalUpdated;

    /**
     * @var int
     */
    public $liveCountryStatus;

    /**
     * @var \DateTimeImmutable
     */
    public $liveCountryStatusUpdated;

    /**
     * @var int
     */
    public $liveCountryStatusAfterDate;

    /**
     * @var \DateTimeImmutable
     */
    public $liveCountryStatusAfterDateUpdated;

    /**
     * @var int
     */
    public $statistics;

    /**
     * @var \DateTimeImmutable
     */
    public $statisticsUpdated;

    /**
     * @var int
     */
    public $default;

    /**
     * @var \DateTimeImmutable
     */
    public $defaultUpdated;

    /**
     * @var int
     */
    public $submitWebhook;

    /**
     * @var \DateTimeImmutable
     */
    public $submitWebhookUpdated;

    /**
     * @var int
     */
    public $summary;

    /**
     * @var \DateTimeImmutable
     */
    public $summaryUpdated;

    public function setData(array $data): void
    {
    }

    public function setAllUpdated(\DateTimeImmutable $allUpdated): void
    {
        $this->allUpdated = $allUpdated;
    }

    public function setCountriesUpdated(\DateTimeImmutable $countriesUpdated): void
    {
        $this->countriesUpdated = $countriesUpdated;
    }

    public function setByCountryUpdated(\DateTimeImmutable $byCountryUpdated): void
    {
        $this->byCountryUpdated = $byCountryUpdated;
    }

    public function setByCountryLiveUpdated(\DateTimeImmutable $byCountryLiveUpdated): void
    {
        $this->byCountryLiveUpdated = $byCountryLiveUpdated;
    }

    public function setByCountryTotalUpdated(\DateTimeImmutable $byCountryTotalUpdated): void
    {
        $this->byCountryTotalUpdated = $byCountryTotalUpdated;
    }

    public function setDayOneUpdated(\DateTimeImmutable $dayOneUpdated): void
    {
        $this->dayOneUpdated = $dayOneUpdated;
    }

    public function setDayOneLiveUpdated(\DateTimeImmutable $dayOneLiveUpdated): void
    {
        $this->dayOneLiveUpdated = $dayOneLiveUpdated;
    }

    public function setDayOneTotalUpdated(\DateTimeImmutable $dayOneTotalUpdated): void
    {
        $this->dayOneTotalUpdated = $dayOneTotalUpdated;
    }

    public function setLiveCountryStatusUpdated(\DateTimeImmutable $liveCountryStatusUpdated): void
    {
        $this->liveCountryStatusUpdated = $liveCountryStatusUpdated;
    }

    public function setLiveCountryStatusAfterDateUpdated(\DateTimeImmutable $liveCountryStatusAfterDateUpdated): void
    {
        $this->liveCountryStatusAfterDateUpdated = $liveCountryStatusAfterDateUpdated;
    }

    public function setStatisticsUpdated(\DateTimeImmutable $statisticsUpdated): void
    {
        $this->statisticsUpdated = $statisticsUpdated;
    }

    public function setDefaultUpdated(\DateTimeImmutable $defaultUpdated): void
    {
        $this->defaultUpdated = $defaultUpdated;
    }

    public function setSubmitWebhookUpdated(\DateTimeImmutable $submitWebhookUpdated): void
    {
        $this->submitWebhookUpdated = $submitWebhookUpdated;
    }

    public function setSummaryUpdated(\DateTimeImmutable $summaryUpdated): void
    {
        $this->summaryUpdated = $summaryUpdated;
    }
}
