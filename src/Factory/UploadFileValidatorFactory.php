<?php

declare(strict_types=1);

namespace Laminas\ApiTools\ContentNegotiation\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ApiTools\ContentNegotiation\Validator\UploadFile;
use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

use function method_exists;

/**
 * @deprecated Will be removed in this fork to reduce dependencies
 */
class UploadFileValidatorFactory implements FactoryInterface
{
    /**
     * Required for v2 compatibility.
     *
     * @var null|array
     */
    private $options;

    /**
     * @param string $requestedName,
     * @param array<string, mixed>|null $options
     * @return UploadFile
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        if (
            $container instanceof AbstractPluginManager
            && ! method_exists($container, 'configure')
        ) {
            $container = $container->getServiceLocator() ?: $container;
        }

        $validator = new UploadFile($options);
        if ($container->has('Request')) {
            $validator->setRequest($container->get('Request'));
        }
        return $validator;
    }

    /**
     * Create and return an UploadFile validator (v2 compatibility)
     *
     * @param null|string $name
     * @param null|string $requestedName
     * @return UploadFile
     */
    public function createService(ServiceLocatorInterface $container, $name = null, $requestedName = null)
    {
        $requestedName = $requestedName ?: UploadFile::class;

        if ($container instanceof AbstractPluginManager) {
            $container = $container->getServiceLocator() ?: $container;
        }

        return $this($container, $requestedName, $this->options);
    }

    /**
     * Allow injecting options at build time; required for v2 compatibility.
     *
     * @return void
     */
    public function setCreationOptions(array $options)
    {
        $this->options = $options;
    }
}
