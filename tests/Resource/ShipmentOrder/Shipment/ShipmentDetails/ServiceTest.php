<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment\ShipmentDetails;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class ServiceTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Resource\ShipmentOrder\Shipment\ShipmentDetails
 */
class ServiceTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $service = new Service();

        $this->assertInstanceOf(Service\AdditionalInsurance::class, $service->AdditionalInsurance);
        $this->assertInstanceOf(Service\BulkyGoods::class, $service->BulkyGoods);
        $this->assertInstanceOf(Service\CashOnDelivery::class, $service->CashOnDelivery);
        $this->assertInstanceOf(Service\DayOfDelivery::class, $service->DayOfDelivery);
        $this->assertInstanceOf(Service\DeliveryTimeframe::class, $service->DeliveryTimeframe);
        $this->assertInstanceOf(Service\Endorsement::class, $service->Endorsement);
        $this->assertInstanceOf(Service\GoGreen::class, $service->GoGreen);
        $this->assertInstanceOf(Service\IdentCheck::class, $service->IdentCheck);
        $this->assertInstanceOf(Service\IndividualSenderRequirement::class, $service->IndividualSenderRequirement);
        $this->assertInstanceOf(Service\NamedPersonOnly::class, $service->NamedPersonOnly);
        $this->assertInstanceOf(Service\NoNeighbourDelivery::class, $service->NoNeighbourDelivery);
        $this->assertInstanceOf(Service\NoticeOfNonDeliverability::class, $service->NoticeOfNonDeliverability);
        $this->assertInstanceOf(Service\PackagingReturn::class, $service->PackagingReturn);
        $this->assertInstanceOf(Service\ParcelOutletRouting::class, $service->ParcelOutletRouting);
        $this->assertInstanceOf(Service\Perishables::class, $service->Perishables);
        $this->assertInstanceOf(Service\PreferredDay::class, $service->PreferredDay);
        $this->assertInstanceOf(Service\PreferredLocation::class, $service->PreferredLocation);
        $this->assertInstanceOf(Service\PreferredNeighbour::class, $service->PreferredNeighbour);
        $this->assertInstanceOf(Service\PreferredTime::class, $service->PreferredTime);
        $this->assertInstanceOf(Service\Premium::class, $service->Premium);
        $this->assertInstanceOf(Service\ReturnImmediately::class, $service->ReturnImmediately);
        $this->assertInstanceOf(Service\ReturnReceipt::class, $service->ReturnReceipt);
        $this->assertInstanceOf(Service\ShipmentHandling::class, $service->ShipmentHandling);
        $this->assertInstanceOf(Service\VisualCheckOfAge::class, $service->VisualCheckOfAge);
    }
}