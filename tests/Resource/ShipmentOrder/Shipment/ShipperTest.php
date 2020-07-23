<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Shipper;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class ShipperTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment
 */
class ShipperTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $shipper = new Shipper();

        $this->assertInstanceOf(Shipper\Address::class, $shipper->Address);
        $this->assertInstanceOf(Shipper\Communication::class, $shipper->Communication);
        $this->assertInstanceOf(Shipper\Name::class, $shipper->Name);
    }
}
