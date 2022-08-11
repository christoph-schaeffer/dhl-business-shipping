<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment;

/**
 * Class Receiver
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment
 *
 * Contains relevant information about Receiver.
 */
class Receiver {

    /**
     * @var Receiver\Address
     *
     * Contains address data.
     */
    public $Address;

    /**
     * @var Receiver\Communication
     *
     * Optional
     *
     * Information about communication.
     */
    public $Communication;

    /**
     * @var Receiver\Packstation
     *
     * Optional
     *
     * The address of the receiver is a Packstation.
     */
    public $Packstation;

    /**
     * @var Receiver\Postfiliale
     *
     * Optional
     *
     * The address of the receiver is a german Postfiliale.
     */
    public $Postfiliale;

    /**
     * @var Receiver\ParcelShop
     *
     * Optional
     *
     * The address of the receiver is a ParcelShop (international variant for "postfiliale").
     */
    public $ParcelShop;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 50
     *
     * Full name or company name of the receiver
     */
    public $name1;

    /**
     * Receiver constructor.
     */
    public function __construct() {
        $this->Address       = new Receiver\Address();
        $this->Communication = new Receiver\Communication();
        $this->Packstation   = new Receiver\Packstation();
        $this->Postfiliale   = new Receiver\Postfiliale();
        $this->ParcelShop    = new Receiver\ParcelShop();
    }


}
