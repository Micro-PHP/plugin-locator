<?php

namespace Micro\Plugin\Locator\Facade;

interface LocatorFacadeInterface
{
    /**
     * @param string $interfaceName
     *
     * @return iterable
     */
    public function lookupClasses(string $interfaceName): iterable;
}