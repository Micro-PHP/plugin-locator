<?php

namespace Micro\Plugin\Locator\Facade;

use Micro\Plugin\Locator\Locator\LocatorFactoryInterface;

class LocatorFacade implements LocatorFacadeInterface
{
    /**
     * @param LocatorFactoryInterface $locatorFactory
     */
    public function __construct(
        private readonly LocatorFactoryInterface $locatorFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function lookupClassesImplementedInterface(string $interfaceName): iterable
    {
        return $this->locatorFactory->create()->lookup($interfaceName);
    }
}