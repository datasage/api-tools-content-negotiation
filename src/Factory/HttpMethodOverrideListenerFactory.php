<?php

declare(strict_types=1);

namespace Laminas\ApiTools\ContentNegotiation\Factory;

use Laminas\ApiTools\ContentNegotiation\ContentNegotiationOptions;
use Laminas\ApiTools\ContentNegotiation\HttpMethodOverrideListener;
use Psr\Container\ContainerInterface;

class HttpMethodOverrideListenerFactory
{
    /**
     * @return HttpMethodOverrideListener
     */
    public function __invoke(ContainerInterface $container)
    {
        $options             = $container->get(ContentNegotiationOptions::class);
        $httpOverrideMethods = $options->getHttpOverrideMethods();
        return new HttpMethodOverrideListener($httpOverrideMethods);
    }
}
