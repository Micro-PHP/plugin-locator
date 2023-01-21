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

/**
 * @todo:
 */
class LocatorCached implements LocatorInterface
{
    /**
     * @var array<string, array<class-string>>
     */
    private array $results;

    public function __construct(
        private readonly LocatorInterface $locator
    ) {
        $this->results = [];
    }

    public function lookup(string $classOrInterfaceName): \Generator
    {
        if (\array_key_exists($classOrInterfaceName, $this->results)) {
            return $this->results[$classOrInterfaceName];
        }

        $results = [];
        foreach ($this->locator->lookup($classOrInterfaceName) as $class) {
            $results[] = $class;

            yield $class;
        }

        $this->results[$classOrInterfaceName] = $results;
    }
}
