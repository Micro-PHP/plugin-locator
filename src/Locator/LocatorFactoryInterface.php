<?php

namespace Micro\Plugin\Locator\Locator;

interface LocatorFactoryInterface
{
    /**
     * @return LocatorInterface
     */
    public function create(): LocatorInterface;
}