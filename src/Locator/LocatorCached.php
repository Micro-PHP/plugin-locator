<?php

namespace Micro\Plugin\Locator\Locator;

/**
 * @todo:
 */
class LocatorCached implements LocatorInterface
{
    private iterable $results;

    /**
     * @param LocatorInterface $locator
     */
    public function __construct(
        private readonly LocatorInterface $locator
    )
    {
        $this->results = [];
    }

    public function lookup(string $classOrInterfaceName): \Generator
    {
        if(array_key_exists($classOrInterfaceName, $this->results)) {
            return $this->results[$classOrInterfaceName];
        }

        $results = [];
        foreach ($this->locator->lookup($classOrInterfaceName) as $class) {
            $results[] = $class;
        }

        $this->results[$classOrInterfaceName] = $results;

        return $results;
    }
}