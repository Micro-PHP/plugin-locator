<?php

namespace Micro\Plugin\Locator;

use Micro\Framework\Kernel\KernelInterface;

class LocatorFactory implements LocatorFactoryInterface
{
    /**
     * @param KernelInterface $kernel
     */
    public function __construct(private readonly KernelInterface $kernel)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): LocatorInterface
    {
        return new Locator($this->kernel);
    }
}