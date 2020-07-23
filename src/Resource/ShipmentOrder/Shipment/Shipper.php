<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment;

/**
 * Class Shipper
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment
 *
 * Contains relevant information about the Shipper.
 */
class Shipper {

    /**
     * @var Shipper\Address
     *
     * Contains address data.
     */
    public $Address;

    /**
     * @var Shipper\Communication
     *
     * Optional
     *
     * Information about communication.
     */
    public $Communication;

    /**
     * @var Shipper\Name
     *
     * Name of the Shipper.
     */
    public $Name;

    /**
     * Shipper constructor.
     */
    public function __construct() {
        $this->Address       = new Shipper\Address();
        $this->Communication = new Shipper\Communication();
        $this->Name          = new Shipper\Name();
    }

}