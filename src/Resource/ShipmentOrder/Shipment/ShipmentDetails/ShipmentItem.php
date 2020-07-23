<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails;

use ChristophSchaeffer\Dhl\BusinessShipping;

/**
 * Class ShipmentItem
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails
 *
 * For every parcel specified, contains weight in kg, length in cm, width in cm and height in cm.
 */
class ShipmentItem {

    /**
     * @var int
     *
     * Optional
     *
     * The height of the piece in cm.
     */
    public $heightInCM;

    /**
     * @var int
     *
     * Optional
     *
     * The length of the piece in cm.
     */
    public $lengthInCM;

    /**
     * @var float
     *
     * Min value: 0.01
     * Max value: 31.5
     *
     * The weight of the piece in kg
     */
    public $weightInKG;

    /**
     * @var int
     *
     * Optional
     *
     * The width of the piece in cm.
     */
    public $widthInCM;

}