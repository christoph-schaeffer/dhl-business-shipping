<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Resource\ShipmentOrder;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;

/**
 * Class ShipmentTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit\Resource\ShipmentOrder
 */
class ShipmentTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $shipment = new Shipment();

        $this->assertInstanceOf(Shipment\ShipmentDetails::class, $shipment->ShipmentDetails);
        $this->assertInstanceOf(Shipment\Shipper::class, $shipment->Shipper);
        $this->assertInstanceOf(Shipment\Receiver::class, $shipment->Receiver);
        $this->assertInstanceOf(Shipment\ReturnReceiver::class, $shipment->ReturnReceiver);
        $this->assertInstanceOf(Shipment\ExportDocument::class, $shipment->ExportDocument);

    }
}
