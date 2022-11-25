<?php

namespace Micro\Plugin\Locator\Configuration;

interface LocatorPluginConfigurationInterface
{
    /**
     * @return string
     */
    public function getCacheDir(): string;
}