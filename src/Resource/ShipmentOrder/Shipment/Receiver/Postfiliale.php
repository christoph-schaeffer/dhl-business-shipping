<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractOrigin;

/**
 * Class Postfiliale
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver
 *
 * The address of the receiver is a german Postfiliale.
 */
class Postfiliale {

    /**
     * @var Postfiliale\Origin
     *
     * Optional
     *
     * Country.
     */
    public $Origin;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 50
     *
     * City name
     */
    public $city;

    /**
     * @var string
     *
     * Min length: 6
     * Max length: 10
     *
     * postNumber of the receiver, if not set receiver e-mail needs to be set.
     */
    public $postNumber;

    /**
     * @var string
     *
     * Min length: 3
     * Max length: 3
     *
     * Number of the postfiliale.
     */
    public $postfilialNumber;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 17
     *
     * Zip code
     */
    public $zip;

    /**
     * Address constructor.
     */
    public function __construct() {
        $this->Origin = new Postfiliale\Origin();
    }
}