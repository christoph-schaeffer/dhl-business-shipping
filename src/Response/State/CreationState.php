<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\State;

use ChristophSchaeffer\Dhl\BusinessShipping\Response\Data\LabelData;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\AbstractStatus;

/**
 * Class ValidationState
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\State
 *
 * The operation's success status for every single ShipmentOrder will be returned by one CreationState element. It is
 * identifiable via SequenceNumber.
 */
class CreationState {

    /**
     * @var int
     *
     * Allowed Values: 1 - 30
     *
     * Identifier for ShipmentOrder set by client application in CreateShipment request. The defined value is looped
     * through and returned unchanged by the web service within the response of createShipment. The client can
     * therefore assign the status information of the response to the correct ShipmentOrder of the request.
     */
    public $sequenceNumber;

    /**
     * @var LabelData
     *
     * For successful operations, a shipment label is created and returned. Depending on the invoked product.
     */
    public $LabelData;

    /**
     * @var string
     *
     * Min length: 1
     * Max length: 39
     *
     * Can contain any DHL shipment number. For successful and unsuccessful operations, the requested ShipmentNumber to
     * be deleted is returned. This is no matter if the operation could be performed or not.
     */
    public $returnShipmentNumber;

    /**
     * @var string
     *
     * Min length: 1
     * Max length: 39
     *
     * Can contain any DHL shipment number. For successful and unsuccessful operations, the requested ShipmentNumber to
     * be deleted is returned. This is no matter if the operation could be performed or not.
     */
    public $shipmentNumber;
}