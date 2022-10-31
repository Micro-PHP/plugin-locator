<?php

namespace Micro\Plugin\Locator\Locator;

interface LocatorInterface
{
    /**
     * @param string $interfaceName
     *
     * @return iterable<string>
     */
    public function lookup(string $interfaceName): iterable;
}