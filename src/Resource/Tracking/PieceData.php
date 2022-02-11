<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking;

/**
 * Class PieceData
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking
 *
 * Used for request on the function getStatusorPublicUser of the TrackingClient
 */
class PieceData
{
    /**
     * @var string
     *
     * This is usually a shipment number
     */
    public $pieceCode;

    /**
     * @var string
     *
     * Optional
     *
     * This is the zip code of the recipient. Only need if you want to see the receipients name.
     * However it is mandatory for international shipments.
     */
    public $zipCode;

    /**
     * @var boolean
     *
     * Optional
     *
     * A flag to indicate if its a international shipment. If it is not this is optional.
     */
    public $internationalShipment;
}
