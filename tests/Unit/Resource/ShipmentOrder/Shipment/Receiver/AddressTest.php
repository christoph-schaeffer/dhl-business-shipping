<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Resource\ShipmentOrder\Shipment\Receiver;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class AddressTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment\Receiver
 */
class AddressTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $address = new Receiver\Address();

        $this->assertInstanceOf(Receiver\Address\Origin::class, $address->Origin);
    }
}
