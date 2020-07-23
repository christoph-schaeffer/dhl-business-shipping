<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Request;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\validateShipment;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class validateShipmentTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Request
 */
class validateShipmentTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstructEmpty() {
        $request = new validateShipment([]);
        $this->assertInstanceOf(Version::class, $request->Version);
        $this->assertNotEmpty($request->Version);

        $this->assertIsArray($request->ShipmentOrder);
        $this->assertEmpty($request->ShipmentOrder);
    }

    /**
     *
     */
    public function testConstructMultiple() {
        $shipmentOrder1                 = new ShipmentOrder();
        $shipmentOrder1->sequenceNumber = 11;
        $shipmentOrder2                 = new ShipmentOrder();
        $shipmentOrder2->sequenceNumber = 12;
        $shipmentOrder3                 = new ShipmentOrder();
        $shipmentOrder3->sequenceNumber = 13;

        $request = new validateShipment([$shipmentOrder1, $shipmentOrder2, $shipmentOrder3]);
        $this->assertInstanceOf(Version::class, $request->Version);
        $this->assertNotEmpty($request->Version);

        $this->assertIsArray($request->ShipmentOrder);
        $this->assertCount(3, $request->ShipmentOrder);

        $this->assertInstanceOf(ShipmentOrder::class, $request->ShipmentOrder[0]);
        $this->assertEquals(11, $request->ShipmentOrder[0]->sequenceNumber);

        $this->assertInstanceOf(ShipmentOrder::class, $request->ShipmentOrder[1]);
        $this->assertEquals(12, $request->ShipmentOrder[1]->sequenceNumber);

        $this->assertInstanceOf(ShipmentOrder::class, $request->ShipmentOrder[2]);
        $this->assertEquals(13, $request->ShipmentOrder[2]->sequenceNumber);
    }

    /**
     *
     */
    public function testConstructSingle() {
        $shipmentOrder                 = new ShipmentOrder();
        $shipmentOrder->sequenceNumber = 22;

        $request = new validateShipment([$shipmentOrder]);
        $this->assertInstanceOf(Version::class, $request->Version);
        $this->assertNotEmpty($request->Version);

        $this->assertIsArray($request->ShipmentOrder);
        $this->assertCount(1, $request->ShipmentOrder);

        $this->assertInstanceOf(ShipmentOrder::class, $request->ShipmentOrder[0]);
        $this->assertEquals(22, $request->ShipmentOrder[0]->sequenceNumber);

    }
}
