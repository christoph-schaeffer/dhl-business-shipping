<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service\IdentCheck;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class IdentCheckTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 */
class IdentCheckTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $identCheck = new IdentCheck();

        $this->assertInstanceOf(IdentCheck\Ident::class, $identCheck->Ident);
    }
}
