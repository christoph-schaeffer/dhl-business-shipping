<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\State;

use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus;

/**
 * Class ValidationState
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\State
 *
 * The operation's success status for every single ShipmentOrder will be returned by one CreationState element. It is
 * identifiable via SequenceNumber.
 */
class ValidationState {

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
     * @var AbstractStatus[]
     *
     * Status objects which have been returned. Those objects can be found in src/Status
     */
    public $Status;
}