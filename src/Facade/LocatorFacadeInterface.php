<?php

namespace Micro\Plugin\Locator\Facade;

interface LocatorFacadeInterface
{
    /**
     * @param string $classOrInterfaceName
     *
     * @return iterable
     */
    public function lookup(string $classOrInterfaceName): iterable;
}