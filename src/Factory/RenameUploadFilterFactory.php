<?php

declare(strict_types=1);

namespace Laminas\ApiTools\ContentNegotiation\Factory;

use Laminas\ApiTools\ContentNegotiation\Filter\RenameUpload;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Override;
use Psr\Container\ContainerInterface;

class RenameUploadFilterFactory implements FactoryInterface
{
    /**
     * @param string $requestedName
     * @param null|array $options
     * @return RenameUpload
     */
    #[Override]
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $filter = new RenameUpload($options);

        if ($container->has('Request')) {
            $filter->setRequest($container->get('Request'));
        }

        return $filter;
    }
}
