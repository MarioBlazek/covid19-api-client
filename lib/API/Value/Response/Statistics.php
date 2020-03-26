<?php

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

    public function setData(array $data)
    {
        // TODO: Implement setData() method.
    }

    /**
     * @param \DateTimeImmutable $allUpdated
     */
    public function setAllUpdated(\DateTimeImmutable $allUpdated): void
    {
        $this->allUpdated = $allUpdated;
    }

    /**
     * @param \DateTimeImmutable $countriesUpdated
     */
    public function setCountriesUpdated(\DateTimeImmutable $countriesUpdated): void
    {
        $this->countriesUpdated = $countriesUpdated;
    }

    /**
     * @param \DateTimeImmutable $byCountryUpdated
     */
    public function setByCountryUpdated(\DateTimeImmutable $byCountryUpdated): void
    {
        $this->byCountryUpdated = $byCountryUpdated;
    }

    /**
     * @param \DateTimeImmutable $byCountryLiveUpdated
     */
    public function setByCountryLiveUpdated(\DateTimeImmutable $byCountryLiveUpdated): void
    {
        $this->byCountryLiveUpdated = $byCountryLiveUpdated;
    }

    /**
     * @param \DateTimeImmutable $byCountryTotalUpdated
     */
    public function setByCountryTotalUpdated(\DateTimeImmutable $byCountryTotalUpdated): void
    {
        $this->byCountryTotalUpdated = $byCountryTotalUpdated;
    }

    /**
     * @param \DateTimeImmutable $dayOneUpdated
     */
    public function setDayOneUpdated(\DateTimeImmutable $dayOneUpdated): void
    {
        $this->dayOneUpdated = $dayOneUpdated;
    }

    /**
     * @param \DateTimeImmutable $dayOneLiveUpdated
     */
    public function setDayOneLiveUpdated(\DateTimeImmutable $dayOneLiveUpdated): void
    {
        $this->dayOneLiveUpdated = $dayOneLiveUpdated;
    }

    /**
     * @param \DateTimeImmutable $dayOneTotalUpdated
     */
    public function setDayOneTotalUpdated(\DateTimeImmutable $dayOneTotalUpdated): void
    {
        $this->dayOneTotalUpdated = $dayOneTotalUpdated;
    }

    /**
     * @param \DateTimeImmutable $liveCountryStatusUpdated
     */
    public function setLiveCountryStatusUpdated(\DateTimeImmutable $liveCountryStatusUpdated): void
    {
        $this->liveCountryStatusUpdated = $liveCountryStatusUpdated;
    }

    /**
     * @param \DateTimeImmutable $liveCountryStatusAfterDateUpdated
     */
    public function setLiveCountryStatusAfterDateUpdated(\DateTimeImmutable $liveCountryStatusAfterDateUpdated): void
    {
        $this->liveCountryStatusAfterDateUpdated = $liveCountryStatusAfterDateUpdated;
    }

    /**
     * @param \DateTimeImmutable $statisticsUpdated
     */
    public function setStatisticsUpdated(\DateTimeImmutable $statisticsUpdated): void
    {
        $this->statisticsUpdated = $statisticsUpdated;
    }

    /**
     * @param \DateTimeImmutable $defaultUpdated
     */
    public function setDefaultUpdated(\DateTimeImmutable $defaultUpdated): void
    {
        $this->defaultUpdated = $defaultUpdated;
    }

    /**
     * @param \DateTimeImmutable $submitWebhookUpdated
     */
    public function setSubmitWebhookUpdated(\DateTimeImmutable $submitWebhookUpdated): void
    {
        $this->submitWebhookUpdated = $submitWebhookUpdated;
    }

    /**
     * @param \DateTimeImmutable $summaryUpdated
     */
    public function setSummaryUpdated(\DateTimeImmutable $summaryUpdated): void
    {
        $this->summaryUpdated = $summaryUpdated;
    }
}
