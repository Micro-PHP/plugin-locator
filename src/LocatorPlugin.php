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

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\KernelInterface;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Plugin\Locator\Configuration\LocatorPluginConfigurationInterface;
use Micro\Plugin\Locator\Facade\LocatorFacade;
use Micro\Plugin\Locator\Facade\LocatorFacadeInterface;
use Micro\Plugin\Locator\Locator\LocatorFactory;
use Micro\Plugin\Locator\Locator\LocatorFactoryInterface;

/**
 * @method LocatorPluginConfigurationInterface configuration()
 */
class LocatorPlugin implements DependencyProviderInterface, ConfigurableInterface
{
    use PluginConfigurationTrait;

    private ?KernelInterface $kernel = null;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(LocatorFacadeInterface::class, function (
            KernelInterface $kernel
        ) {
            $this->kernel = $kernel;

            return $this->createLocatorFacade();
        });
    }

    protected function createLocatorFacade(): LocatorFacadeInterface
    {
        return new LocatorFacade(
            $this->createLocatorFactory()
        );
    }

    protected function createLocatorFactory(): LocatorFactoryInterface
    {
        return new LocatorFactory($this->kernel);
    }
}
