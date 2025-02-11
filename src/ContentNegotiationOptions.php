<?php

declare(strict_types=1);

namespace Laminas\ApiTools\ContentNegotiation;

use Laminas\Stdlib\AbstractOptions;
use Laminas\Stdlib\Exception\BadMethodCallException;

use function array_merge_recursive;
use function str_replace;

class ContentNegotiationOptions extends AbstractOptions
{
    /** @var array */
    protected $controllers = [];

    /** @var array */
    protected $selectors = [];

    /** @var array */
    protected $acceptWhitelist = [];

    /** @var array */
    protected $contentTypeWhitelist = [];

    /** @var boolean */
    protected $xHttpMethodOverrideEnabled = false;

    /** @var array */
    protected $httpOverrideMethods = [];

    /** @var array */
    private $keysToNormalize = [
        'accept-whitelist',
        'content-type-whitelist',
        'x-http-method-override-enabled',
        'http-override-methods',
    ];

    /**
     * {@inheritDoc}
     *
     * Normalizes and merges the configuration for specific configuration keys
     *
     * @see self::normalizeOptions
     */
    public function setFromArray($options)
    {
        return parent::setFromArray(
            $this->normalizeOptions($options)
        );
    }

    /**
     * This method uses the config keys given in $keyToNormalize to merge
     * the config.
     * It uses Laminas's default approach of merging configs, by merging them with
     * `array_merge_recursive()`.
     *
     * @return array
     */
    private function normalizeOptions(array $config)
    {
        $mergedConfig = $config;

        foreach ($this->keysToNormalize as $key) {
            $normalizedKey = $this->normalizeKey($key);

            if (isset($config[$key]) && isset($config[$normalizedKey])) {
                $mergedConfig[$normalizedKey] = array_merge_recursive(
                    $config[$key],
                    $config[$normalizedKey]
                );
                unset($mergedConfig[$key]);
                continue;
            }

            if (isset($config[$key])) {
                $mergedConfig[$normalizedKey] = $config[$key];
                unset($mergedConfig[$key]);
                continue;
            }

            if (isset($config[$normalizedKey])) {
                $mergedConfig[$normalizedKey] = $config[$normalizedKey];
                continue;
            }
        }

        return $mergedConfig;
    }

    /**
     * @deprecated since 1.4.0; hhould be removed in next major version, and only one
     *     configuration key style should be supported.
     *
     * @param string $key
     * @return string
     */
    private function normalizeKey($key)
    {
        return str_replace('-', '_', $key);
    }

    /**
     * {@inheritDoc}
     *
     * Normalizes dash-separated keys to underscore-separated to ensure
     * backwards compatibility with old options (even though dash-separated
     * were previously ignored!).
     *
     * @see \Laminas\Stdlib\ParameterObject::__set()
     *
     * @param string $key
     * @param mixed $value
     * @throws BadMethodCallException
     * @return void
     */
    public function __set($key, $value)
    {
        parent::__set($this->normalizeKey($key), $value);
    }

    /**
     * {@inheritDoc}
     *
     * Normalizes dash-separated keys to underscore-separated to ensure
     * backwards compatibility with old options (even though dash-separated
     * were previously ignored!).
     *
     * @see \Laminas\Stdlib\ParameterObject::__get()
     *
     * @param string $key
     * @throws BadMethodCallException
     * @return mixed
     */
    public function __get($key)
    {
        return parent::__get($this->normalizeKey($key));
    }

    /**
     * @return void
     */
    public function setControllers(array $controllers)
    {
        $this->controllers = $controllers;
    }

    /**
     * @return array
     */
    public function getControllers()
    {
        return $this->controllers;
    }

    /**
     * @return void
     */
    public function setSelectors(array $selectors)
    {
        $this->selectors = $selectors;
    }

    /**
     * @return array
     */
    public function getSelectors()
    {
        return $this->selectors;
    }

    /**
     * @return void
     */
    public function setAcceptWhitelist(array $whitelist)
    {
        $this->acceptWhitelist = $whitelist;
    }

    /**
     * @return array
     */
    public function getAcceptWhitelist()
    {
        return $this->acceptWhitelist;
    }

    /**
     * @return void
     */
    public function setContentTypeWhitelist(array $whitelist)
    {
        $this->contentTypeWhitelist = $whitelist;
    }

    /**
     * @return array
     */
    public function getContentTypeWhitelist()
    {
        return $this->contentTypeWhitelist;
    }

    /**
     * @param boolean $xHttpMethodOverrideEnabled
     * @return void
     */
    public function setXHttpMethodOverrideEnabled($xHttpMethodOverrideEnabled)
    {
        $this->xHttpMethodOverrideEnabled = $xHttpMethodOverrideEnabled;
    }

    /**
     * @return boolean
     */
    public function getXHttpMethodOverrideEnabled()
    {
        return $this->xHttpMethodOverrideEnabled;
    }

    /**
     * @return void
     */
    public function setHttpOverrideMethods(array $httpOverrideMethods)
    {
        $this->httpOverrideMethods = $httpOverrideMethods;
    }

    /**
     * @return array
     */
    public function getHttpOverrideMethods()
    {
        return $this->httpOverrideMethods;
    }
}
