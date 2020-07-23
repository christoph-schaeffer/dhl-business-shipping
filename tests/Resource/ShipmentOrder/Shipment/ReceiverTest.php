<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class ReceiverTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment
 */
class ReceiverTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $receiver = new Receiver();

        $this->assertInstanceOf(Receiver\Address::class, $receiver->Address);
        $this->assertInstanceOf(Receiver\Communication::class, $receiver->Communication);
        $this->assertInstanceOf(Receiver\Packstation::class, $receiver->Packstation);
        $this->assertInstanceOf(Receiver\Postfiliale::class, $receiver->Postfiliale);
    }
}
