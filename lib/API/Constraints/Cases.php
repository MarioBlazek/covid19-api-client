<?php

namespace Marek\Covid19\API\Constraints;

final class Cases
{
    public const CONFIRMED = 'confirmed';

    public const RECOVERED = 'recovered';

    public const DEATHS = 'deaths';

    public static function getValidEntries(): array
    {
        return [
            self::CONFIRMED,
            self::DEATHS,
            self::RECOVERED,
        ];
    }
}
