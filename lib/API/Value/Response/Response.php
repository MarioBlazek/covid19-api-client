<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Value\Response;

abstract class Response
{
    abstract public function setData(array $data);
}
