<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Request;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\updateShipmentOrder;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class updateShipmentOrderTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Request
 */
class updateShipmentOrderTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstructEmpty() {
        $request = new updateShipmentOrder('', (new ShipmentOrder()));
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

        $this->assertIsString($request->shipmentNumber);
        $this->assertEquals('sendungsnummer', $request->shipmentNumber);

    }
}
