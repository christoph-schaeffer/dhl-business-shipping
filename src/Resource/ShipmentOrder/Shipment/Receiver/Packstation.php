<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractOrigin;

/**
 * Class Packstation
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver
 *
 * The address of the receiver is a german Packstation.
 */
class Packstation {

    /**
     * @var AbstractOrigin
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
     * Min length: 3
     * Max length: 3
     *
     * Number of the Packstation.
     */
    public $packstationNumber;

    /**
     * @var string
     *
     * Min length: 6
     * Max length: 10
     *
     * Post number of the receiver
     */
    public $postNumber;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * Province name.
     */
    public $province;

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
        $this->Origin = new Packstation\Origin();
    }

}