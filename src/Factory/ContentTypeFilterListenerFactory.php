<?php

declare(strict_types=1);

namespace Laminas\ApiTools\ContentNegotiation\Factory;

use Laminas\ApiTools\ContentNegotiation\ContentNegotiationOptions;
use Laminas\ApiTools\ContentNegotiation\ContentTypeFilterListener;
use Psr\Container\ContainerInterface;

class ContentTypeFilterListenerFactory
{
    /**
     * @return ContentTypeFilterListener
     */
    public function __invoke(ContainerInterface $container)
    {
        $listener = new ContentTypeFilterListener();

        $options = $container->get(ContentNegotiationOptions::class);
        $listener->setConfig($options->getContentTypeWhitelist());

        return $listener;
    }
}
