<?php

namespace Marek\Covid19\API\Constraints;

final class TimeToLive
{
    public const TTL_ONE_HOUR = 3600;
    public const TTL_NONE = 0;
    public const TTL_ONE_DAY = 86400;
    public const TTL_ONE_MINUTE = 60;
}
