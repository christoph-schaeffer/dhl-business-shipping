<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource;

/**
 * Class ShipmentOrder
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource
 *
 * ShipmentOrder is the highest parent element that contains all data with respect to one shipment order.
 */
class ShipmentOrder {

    /**
     * @var ShipmentOrder\Shipment
     *
     * This is the core element of a ShipmentOrder. It contains all relevant information of the shipment.
     */
    public $Shipment;

    /**
     * @var ShipmentOrder\PrintOnlyIfCodeable
     *
     * Optional
     *
     * If active is set to TRUE, the label will only be printable, if the receiver address is valid.
     */
    public $PrintOnlyIfCodeable;

    /**
     * @var int
     *
     * Allowed Values: 1 - 30
     *
     * Free field to to tag multiple(up to 30) shipment orders individually by client. Essential for later mapping of
     * response data returned by webservice upon createShipment operation. Allows client to assign the shipment
     * information of the response to the correct shipment order of the request.
     */
    public $sequenceNumber = 1;

    /**
     * ShipmentOrder constructor.
     */
    public function __construct() {
        $this->Shipment            = new ShipmentOrder\Shipment();
        $this->PrintOnlyIfCodeable = new ShipmentOrder\PrintOnlyIfCodeable();
    }

}