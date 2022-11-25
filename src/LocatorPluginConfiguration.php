<?php

namespace Micro\Plugin\Locator;

use Micro\Framework\Kernel\Configuration\PluginConfiguration;
use Micro\Plugin\Locator\Configuration\LocatorPluginConfigurationInterface;

class LocatorPluginConfiguration extends PluginConfiguration implements LocatorPluginConfigurationInterface
{
    const CFG_CACHE_DIR = 'LOCATOR_CACHE_DIR';

    /**
     * {@inheritDoc}
     */
    public function getCacheDir(): string
    {
        $dir = $this->configuration->get(self::CFG_CACHE_DIR, null);
        if(!$dir) {
            return $this->getDefaultCacheDir();
        }
    }

    /**
     * @return string
     */
    protected function getDefaultCacheDir(): string
    {
        return $this->configuration->get('BASE_PATH') . '/var/cache/locator';
    }
}