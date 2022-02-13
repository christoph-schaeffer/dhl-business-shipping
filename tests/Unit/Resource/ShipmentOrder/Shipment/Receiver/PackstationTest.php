<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Resource\ShipmentOrder\Shipment\Receiver;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class PackstationTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment\Receiver
 */
class PackstationTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $packstation = new Receiver\Packstation();

        $this->assertInstanceOf(Receiver\Packstation\Origin::class, $packstation->Origin);
    }
}
