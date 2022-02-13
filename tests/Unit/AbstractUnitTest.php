<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractUnitTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit
 */
abstract class AbstractUnitTest extends TestCase {

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
     * @param object $object
     * @param string $methodName
     * @param array  $args
     *
     * @return mixed
     * @throws \ReflectionException
     */
    protected function runProtectedMethod($object, $methodName, $args = []) {
        $method = new \ReflectionMethod(get_class($object), $methodName);
        $method->setAccessible(TRUE);

        return $method->invokeArgs($object, $args);
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