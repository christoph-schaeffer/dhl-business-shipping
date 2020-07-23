<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver;

use \ChristophSchaeffer\Dhl\BusinessShipping\Resource;

/**
 * Class Address
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver
 *
 * The address of the shipment receiver
 */
class Address extends Resource\AbstractAddress {

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 50
     *
     * Full name or company name (line 2)
     */
    public $name2;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 50
     *
     * Full name or company name (line 3)
     */
    public $name3;

    /**
     * Address constructor.
     */
    public function __construct() {
        $this->Origin = new Address\Origin();
    }

}