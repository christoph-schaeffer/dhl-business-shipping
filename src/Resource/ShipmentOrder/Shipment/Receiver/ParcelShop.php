<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver;

/**
 * Class ParcelShop
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\Receiver
 *
 * The address of the receiver is a parcel shop. receiver is in Europe. non-national variant for "postfiliale"
 */
class ParcelShop {

    /**
     * @var ParcelShop\Origin
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
     * Min length: 0
     * Max length: ?
     *
     * Number of the ParcelShop
     */
    public $parcelShopNumber;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 35
     *
     * Name of street of the ParcelShop
     */
    public $streetName;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 5
     *
     * House number of the ParcelShop
     */
    public $streetNumber;

    /**
     * @var string
     *
     * Min length: 5
     * Max length: 5
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
