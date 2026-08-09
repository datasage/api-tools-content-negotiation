<?php

declare(strict_types=1);

namespace Laminas\ApiTools\ContentNegotiation\Factory;

use Laminas\ApiTools\ContentNegotiation\Validator\UploadFile;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Override;
use Psr\Container\ContainerInterface;

/**
 * @deprecated Will be removed in this fork to reduce dependencies
 */
class UploadFileValidatorFactory implements FactoryInterface
{
    /**
     * @param string $requestedName
     * @param array<string, mixed>|null $options
     * @return UploadFile
     */
    #[Override]
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $validator = new UploadFile($options);

        if ($container->has('Request')) {
            $validator->setRequest($container->get('Request'));
        }

        return $validator;
    }
}
