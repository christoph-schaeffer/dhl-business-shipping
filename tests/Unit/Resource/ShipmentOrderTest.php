<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Resource;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;

/**
 * Class ShipmentOrderTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit\Resource
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
