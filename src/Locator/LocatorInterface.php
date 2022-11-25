<?php

namespace Micro\Plugin\Locator\Locator;

interface LocatorInterface
{
    /**
     * @param string $classOrInterfaceName
     *
     * @return \Generator<string>
     */
    public function lookup(string $classOrInterfaceName): \Generator;
}