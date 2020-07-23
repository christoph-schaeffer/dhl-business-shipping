<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment;

/**
 * Class ReturnReceiver
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment
 *
 * To be used if a return label address shall be generated.
 */
class ReturnReceiver {

    /**
     * @var ReturnReceiver\Address
     *
     * Contains address data.
     */
    public $Address;

    /**
     * @var returnreceiver\communication
     *
     * optional
     *
     * Information about communication.
     */
    public $Communication;

    /**
     * @var ReturnReceiver\Name
     *
     * Name of the return receiver.
     */
    public $Name;

    /**
     * ReturnReceiver constructor.
     */
    public function __construct() {
        $this->Address       = new ReturnReceiver\Address();
        $this->Communication = new ReturnReceiver\Communication();
        $this->Name          = new ReturnReceiver\Name();
    }

}