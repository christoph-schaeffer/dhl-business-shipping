<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Resource\ShipmentOrder\Shipment\Receiver;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;

/**
 * Class PostfilialeTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment\Receiver
 */
class PostfilialeTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $postfiliale = new Receiver\Postfiliale();

        $this->assertInstanceOf(Receiver\Postfiliale\Origin::class, $postfiliale->Origin);
    }
}
