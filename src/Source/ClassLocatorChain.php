<?php

declare(strict_types=1);

namespace ExtendedTypeSystem\Source;

use ExtendedTypeSystem\ClassLocator;

/**
 * @psalm-api
 */
final class ClassLocatorChain implements ClassLocator
{
    /**
     * @param iterable<ClassLocator> $classLocators
     */
    public function __construct(
        private readonly iterable $classLocators = [],
    ) {
    }

    public function locateClass(string $class): ?Source
    {
        foreach ($this->classLocators as $classLocator) {
            $source = $classLocator->locateClass($class);

            if ($source !== null) {
                return $source;
            }
        }

        return null;
    }
}
