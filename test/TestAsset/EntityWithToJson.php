<?php

declare(strict_types=1);

namespace LaminasTest\ApiTools\ContentNegotiation\TestAsset;

/**
 * An entity exposing toJson(), which Laminas\Json\Json::encode() returned verbatim and
 * in preference to toArray() or native encoding. JsonModel preserves that precedence.
 */
class EntityWithToJson
{
    public string $publicProperty = 'from-property';

    /** @return array<string, string> */
    public function toArray(): array
    {
        return ['from' => 'toArray'];
    }

    public function toJson(): string
    {
        return '{"from":"toJson"}';
    }
}
