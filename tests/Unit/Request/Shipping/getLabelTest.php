<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Request\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getLabel;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;

/**
 * Class getLabelTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Request\Shipping
 */
class getLabelTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstructEmpty() {
        $request = new getLabel([]);

        $this->assertInstanceOf(Version::class, $request->Version);
        $this->assertNotEmpty($request->Version);
        $this->assertTrue(is_array($request->shipmentNumber));
        $this->assertEmpty($request->shipmentNumber);
    }

    /**
     *
     */
    public function testConstructMultiple() {
        $request = new getLabel(['tester1', 'tester2', 'tester3']);

        $this->assertInstanceOf(Version::class, $request->Version);
        $this->assertNotEmpty($request->Version);
        $this->assertTrue(is_array($request->shipmentNumber));
        $this->assertCount(3, $request->shipmentNumber);
        $this->assertEquals('tester1', $request->shipmentNumber[0]);
        $this->assertEquals('tester2', $request->shipmentNumber[1]);
        $this->assertEquals('tester3', $request->shipmentNumber[2]);

    }

    /**
     *
     */
    public function testConstructSingle() {
        $request = new getLabel(['tester']);

        $this->assertInstanceOf(Version::class, $request->Version);
        $this->assertNotEmpty($request->Version);
        $this->assertTrue(is_array($request->shipmentNumber));
        $this->assertCount(1, $request->shipmentNumber);
        $this->assertEquals('tester', $request->shipmentNumber[0]);

    }
}
