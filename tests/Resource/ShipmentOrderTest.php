<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class ShipmentOrderTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Resource
 */
class ShipmentOrderTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $shipmentOrder = new ShipmentOrder();

        $this->assertInstanceOf(ShipmentOrder\Shipment::class, $shipmentOrder->Shipment);
    }
}
