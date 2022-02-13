<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Resource\ShipmentOrder\Shipment;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class ShipmentDetailsTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment
 */
class ShipmentDetailsTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $shipmentDetails = new ShipmentDetails();

        $this->assertInstanceOf(ShipmentDetails\Notification::class, $shipmentDetails->Notification);
        $this->assertInstanceOf(ShipmentDetails\BankData::class, $shipmentDetails->BankData);
        $this->assertInstanceOf(ShipmentDetails\ShipmentItem::class, $shipmentDetails->ShipmentItem);
        $this->assertInstanceOf(ShipmentDetails\Service::class, $shipmentDetails->Service);
    }
}