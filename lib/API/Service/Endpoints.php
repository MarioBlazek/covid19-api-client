<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Service;

use Marek\Covid19\API\Value\Parameter\Country;
use Marek\Covid19\API\Value\Parameter\DateAndTime;
use Marek\Covid19\API\Value\Parameter\Status;
use Marek\Covid19\API\Value\Response\AllData;
use Marek\Covid19\API\Value\Response\Countries;
use Marek\Covid19\API\Value\Response\Report;
use Marek\Covid19\API\Value\Response\Statistics;
use Marek\Covid19\API\Value\Response\Summary;

interface Endpoints
{
    /**
     * A summary of new and total cases per country updated daily.
     *
     * @return \Marek\Covid19\API\Value\Response\Summary
     */
    public function getSummary(): Summary;

    /**
     * Returns all the available countries and provinces, as well as the country slug for per country requests.
     *
     * @return \Marek\Covid19\API\Value\Response\Countries
     */
    public function getCountries(): Countries;

    /**
     * Returns all cases by case type for a country from the first recorded case.
     *
     * @param \Marek\Covid19\API\Value\Parameter\Country $country
     * @param \Marek\Covid19\API\Value\Parameter\Status $status
     *
     * @return \Marek\Covid19\API\Value\Response\Report
     */
    public function getDayOne(Country $country, Status $status): Report;

    /**
     * Returns all cases by case type for a country from the first recorded case with the latest record being the live count.
     *
     * @param \Marek\Covid19\API\Value\Parameter\Country $country
     * @param \Marek\Covid19\API\Value\Parameter\Status $status
     *
     * @return \Marek\Covid19\API\Value\Response\Report
     */
    public function getDayOneLive(Country $country, Status $status): Report;

    /**
     * Returns all cases by case type for a country from the first recorded case.
     *
     * @param \Marek\Covid19\API\Value\Parameter\Country $country
     * @param \Marek\Covid19\API\Value\Parameter\Status $status
     *
     * @return \Marek\Covid19\API\Value\Response\Report
     */
    public function getDayOneTotal(Country $country, Status $status): Report;

    /**
     * Returns all cases by case type for a country.
     *
     * @param \Marek\Covid19\API\Value\Parameter\Country $country
     * @param \Marek\Covid19\API\Value\Parameter\Status $status
     *
     * @return \Marek\Covid19\API\Value\Response\Report
     */
    public function getByCountry(Country $country, Status $status): Report;

    /**
     *
     *
     * @param \Marek\Covid19\API\Value\Parameter\Country $country
     * @param \Marek\Covid19\API\Value\Parameter\Status $status
     *
     * @return \Marek\Covid19\API\Value\Response\Report
     */
    public function getByCountryLive(Country $country, Status $status): Report;

    /**
     * Returns all cases by case type for a country.
     *
     * @param \Marek\Covid19\API\Value\Parameter\Country $country
     * @param \Marek\Covid19\API\Value\Parameter\Status $status
     *
     * @return \Marek\Covid19\API\Value\Response\Report
     */
    public function getByCountryTotal(Country $country, Status $status): Report;

    /**
     * Returns all live cases by case type for a country. These records are pulled every 10 minutes and are ungrouped.
     *
     * @param \Marek\Covid19\API\Value\Parameter\Country $country
     * @param \Marek\Covid19\API\Value\Parameter\Status $status
     *
     * @return \Marek\Covid19\API\Value\Response\Report
     */
    public function getLiveByCountryAndStatus(Country $country, Status $status): Report;

    /**
     * Returns all live cases by case type for a country after a given date. These records are pulled every 10 minutes and are ungrouped.
     *
     * @param \Marek\Covid19\API\Value\Parameter\Country $country
     * @param \Marek\Covid19\API\Value\Parameter\Status $status
     *
     * @return \Marek\Covid19\API\Value\Response\Report
     */
    public function getLiveByCountryAndStatusAfterDate(Country $country, Status $status, DateAndTime $date): Report;

    /**
     * Returns all daily data. This call results in 10MB of data being returned and should be used infrequently.
     *
     * @return \Marek\Covid19\API\Value\Response\AllData
     */
    public function getAllData(): AllData;

    /**
     * @return \Marek\Covid19\API\Value\Response\Statistics
     */
    public function getStatistics(): Statistics;
}
