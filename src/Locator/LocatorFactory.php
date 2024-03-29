<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Locator\Locator;

use Micro\Framework\Kernel\KernelInterface;

class LocatorFactory implements LocatorFactoryInterface
{
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
