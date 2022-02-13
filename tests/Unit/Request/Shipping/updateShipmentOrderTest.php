<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Request\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\updateShipmentOrder;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;

/**
 * Class updateShipmentOrderTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Request\Shipping
 */
class updateShipmentOrderTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstructEmpty() {
        $request = new \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\updateShipmentOrder('', (new ShipmentOrder()));
        $this->assertInstanceOf(Version::class, $request->Version);
        $this->assertNotEmpty($request->Version);

        $this->assertInstanceOf(ShipmentOrder::class, $request->ShipmentOrder);
        $this->assertEmpty($request->shipmentNumber);
    }

    /**
     *
     */
    public function testConstructSingle() {
        $shipmentOrder                 = new ShipmentOrder();
        $shipmentOrder->sequenceNumber = 22;

        $request = new updateShipmentOrder('sendungsnummer', $shipmentOrder);
        $this->assertInstanceOf(Version::class, $request->Version);
        $this->assertNotEmpty($request->Version);

        $this->assertInstanceOf(ShipmentOrder::class, $request->ShipmentOrder);
        $this->assertEquals(22, $request->ShipmentOrder->sequenceNumber);

        $this->assertTrue(is_string($request->shipmentNumber));
        $this->assertEquals('sendungsnummer', $request->shipmentNumber);

    }
}
