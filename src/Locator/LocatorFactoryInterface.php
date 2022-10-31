<?php

namespace Micro\Plugin\Locator;

interface LocatorFactoryInterface
{
    /**
     * @return LocatorInterface
     */
    public function create(): LocatorInterface;
}