<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Shipper;

use \ChristophSchaeffer\Dhl\BusinessShipping\Resource;

/**
 * Class Address
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Shipper
 *
 * The address of the shipment sender
 */
class Address extends Resource\AbstractAddress {

    /**
     * Address constructor.
     */
    public function __construct() {
        $this->Origin = new Address\Origin();
    }
}