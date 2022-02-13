<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Resource\ShipmentOrder\Shipment;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ReturnReceiver;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;

/**
 * Class ReturnReceiverTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment
 */
class ReturnReceiverTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $returnReceiver = new ReturnReceiver();

        $this->assertInstanceOf(ReturnReceiver\Address::class, $returnReceiver->Address);
        $this->assertInstanceOf(ReturnReceiver\Communication::class, $returnReceiver->Communication);
        $this->assertInstanceOf(ReturnReceiver\Name::class, $returnReceiver->Name);
    }
}