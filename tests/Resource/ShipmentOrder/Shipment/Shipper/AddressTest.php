<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment\Shipper;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Shipper;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class AddressTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment\Shipper
 */
class AddressTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $address = new Shipper\Address();

        $this->assertInstanceOf(Shipper\Address\Origin::class, $address->Origin);
    }
}
