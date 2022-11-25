<?php

namespace Micro\Plugin\Locator\Locator;

use Micro\Framework\Kernel\KernelInterface;
use Symfony\Component\Finder\Finder;

class Locator implements LocatorInterface
{
    /**
     * @param KernelInterface $kernel
     */
    public function __construct(
        private readonly KernelInterface $kernel
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function lookup(string $classOrInterfaceName): \Generator
    {
        $isInterface = interface_exists($classOrInterfaceName);

        if(!$isInterface && !class_exists($classOrInterfaceName)) {
            return;
        }

        foreach ($this->kernel->plugins() as $plugin) {
            $reflection = $this->createReflectionClass($plugin);
            foreach ($this->getPluginClasses($reflection) as $pluginInternalClassName) {
                $pluginClassReflection = $this->createReflectionClass($pluginInternalClassName);

                if($isInterface) {
                    if(!in_array($classOrInterfaceName, $pluginClassReflection->getInterfaceNames())) {
                        continue;
                    }

                    yield $pluginInternalClassName;

                    continue;
                }

                if(!$pluginClassReflection->isSubclassOf($classOrInterfaceName)) {
                    continue;
                }

                yield $pluginInternalClassName;
            }
        }
    }

    /**
     * @param \ReflectionClass $reflection
     *
     * @return iterable
     */
    protected function getPluginClasses(\ReflectionClass $reflection): iterable
    {
        $pluginBasePath = dirname($reflection->getFileName());
        $pluginNamespace = $reflection->getNamespaceName();

        $finder = new Finder();
        try {
            $finder
                ->in($pluginBasePath . '/**')
                ->name('*.php')
                ->notName('*Interface.php');

        } catch (\Throwable $exception) {
            return [];
        }

        foreach ($finder as $fileClass) {
            $relative = str_replace($pluginBasePath, '', $fileClass);
            $namespaceRelative = str_replace('/', '\\', $relative);

            yield str_replace('.php', '', $pluginNamespace . $namespaceRelative);
        }
    }

    /**
     * @param string|object $objectOrClass
     *
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    protected function createReflectionClass(string|object $objectOrClass): \ReflectionClass
    {
        return new \ReflectionClass($objectOrClass);
    }
}