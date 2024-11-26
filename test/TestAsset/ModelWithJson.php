<?php

declare(strict_types=1);

namespace LaminasTest\ApiTools\ContentNegotiation\TestAsset;

use JsonSerializable;
use ReturnTypeWillChange;

class ModelWithJson implements JsonSerializable
{
    /** @return mixed */
    #[ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return ['foo' => 'bar'];
    }
}
