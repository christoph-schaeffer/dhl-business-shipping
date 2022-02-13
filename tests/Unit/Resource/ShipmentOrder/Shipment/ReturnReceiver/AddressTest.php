<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Resource\ShipmentOrder\Shipment\ReturnReceiver;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ReturnReceiver;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class AddressTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment\ReturnReceiver
 */
class AddressTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $address = new ReturnReceiver\Address();

        $this->assertInstanceOf(ReturnReceiver\Address\Origin::class, $address->Origin);
    }
}
