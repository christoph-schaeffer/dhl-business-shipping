<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class deleteShipmentOrder
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * This operation cancels earlier created shipments. However, this will only work for shipments for that you
 * haven't called the doManifest function. Also keep in mind that if not set otherwise in the
 * "Geschäftskundenportal" there will be an automatic doManifest call on all open shipments at 6 pm every day.
 */
class deleteShipmentOrder extends AbstractRequest {

    /**
     * @var string[]
     *
     * Min length: 1(per entry)
     * Max length: 39(per entry)
     *
     * Can contain any DHL shipment number or multiple shipment numbers
     */
    public $shipmentNumber;

    /**
     * @param string[] $shipmentNumbers
     *
     * deleteShipmentOrder constructor.
     */
    public function __construct(array $shipmentNumbers) {
        parent::__construct();
        $this->shipmentNumber = $shipmentNumbers;
    }

}