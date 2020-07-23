<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ReturnReceiver;

use \ChristophSchaeffer\Dhl\BusinessShipping\Resource;

/**
 * Class Address
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ReturnReceiver
 *
 * The address the shipment should be returned to. This is only used when printing a return label.
 */
class Address extends Resource\AbstractAddress {

    /**
     * Address constructor.
     */
    public function __construct() {
        $this->Origin = new Address\Origin();
    }
}