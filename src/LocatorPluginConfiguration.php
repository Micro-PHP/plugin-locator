<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Locator;

use Micro\Framework\Kernel\Configuration\PluginConfiguration;
use Micro\Plugin\Locator\Configuration\LocatorPluginConfigurationInterface;

class LocatorPluginConfiguration extends PluginConfiguration implements LocatorPluginConfigurationInterface
{
    public const CFG_CACHE_DIR = 'LOCATOR_CACHE_DIR';

    public function getCacheDir(): string
    {
        $dir = $this->configuration->get(self::CFG_CACHE_DIR);
        if (!$dir) {
            $dir = $this->getDefaultCacheDir();
        }

        return $dir;
    }

    protected function getDefaultCacheDir(): string
    {
        return $this->configuration->get('BASE_PATH').'/var/cache/locator';
    }
}
