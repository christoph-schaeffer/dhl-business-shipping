<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Integration;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractIntegrationTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Integration
 */
abstract class AbstractIntegrationTest extends TestCase {

    /**
     * @param Object $object
     * @param string $propertyName
     *
     * @return mixed
     * @throws \ReflectionException
     */
    protected function getProtectedPropertyValue($object, $propertyName) {
        $property = new \ReflectionProperty(get_class($object), $propertyName);
        $property->setAccessible(TRUE);

        return $property->getValue($object);
    }

    /**
     * @param Object $object
     * @param string $propertyName
     * @param mixed  $value
     *
     * @return Object
     * @throws \ReflectionException
     */
    protected function setProtectedPropertyValue($object, $propertyName, $value) {
        $property = new \ReflectionProperty(get_class($object), $propertyName);
        $property->setAccessible(TRUE);

        $property->setValue($object, $value);
        return $object;
    }
}