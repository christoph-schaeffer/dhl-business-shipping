<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\State;

use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\AbstractStatus;

/**
 * Class DeletionState
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\State
 *
 * For every ShipmentNumber requested, one DeletionState node is returned that contains the status of the
 * respective deletion operation.
 */
class DeletionState {

    /**
     * @var string
     *
     * Min length: 1
     * Max length: 39
     *
     * Can contain any DHL shipmentnumber
     */
    public $shipmentNumber;

    /**
     * @var AbstractStatus[]
     *
     * Status objects which have been returned. Those objects can be found in src/Status
     */
    public $Status;

}