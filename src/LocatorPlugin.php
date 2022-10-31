<?php

namespace Micro\Plugin\Locator;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\KernelInterface;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Kernel\App\AppKernelInterface;
use Micro\Plugin\Locator\Facade\LocatorFacade;
use Micro\Plugin\Locator\Facade\LocatorFacadeInterface;
use Micro\Plugin\Locator\Locator\LocatorFactory;
use Micro\Plugin\Locator\Locator\LocatorFactoryInterface;

class LocatorPlugin extends AbstractPlugin
{
    private ?KernelInterface $kernel = null;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(LocatorFacadeInterface::class, function (
            AppKernelInterface $kernel
        ) {
            $this->kernel = $kernel;

            return $this->createLocatorFacade();
        });
    }

    /**
     * @return LocatorFacadeInterface
     */
    protected function createLocatorFacade(): LocatorFacadeInterface
    {
        return new LocatorFacade(
            $this->createLocatorFactory()
        );
    }

    /**
     * @return LocatorFactoryInterface
     */
    protected function createLocatorFactory(): LocatorFactoryInterface
    {
        return new LocatorFactory($this->kernel);
    }
}