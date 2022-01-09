<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\State;

use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus;

/**
 * Class ManifestState
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\State
 *
 * The status of the operation for the corresponding shipment(s).
 */
class ManifestState {

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
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus[]
     *
     * Status objects which have been returned. Those objects can be found in src/Status
     */
    public $Status;

}