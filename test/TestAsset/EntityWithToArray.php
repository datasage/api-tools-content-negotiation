<?php

declare(strict_types=1);

namespace LaminasTest\ApiTools\ContentNegotiation\TestAsset;

/**
 * An entity exposing toArray(), which is the common shape inside a HAL entity.
 *
 * Laminas\Json\Json::encode() gave toArray() precedence over native encoding, so
 * JsonModel preserves that branch; without it the public property would be serialized
 * instead of the toArray() payload.
 */
class EntityWithToArray
{
    public string $publicProperty = 'from-property';

    /** @return array<string, string> */
    public function toArray(): array
    {
        return ['from' => 'toArray'];
    }
}
