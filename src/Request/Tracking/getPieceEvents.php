<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;

/**
 * Class getPieceEvents
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * @TODO description
 */
class getPieceEvents extends AbstractTrackingRequest {

    /**
     * @var string
     *
     * The piece id. not to be confused with the tracking number ("Sendungsnummer") of the shipment you want to get data of.
     * This is not the tracking number. A piece id looks like this: 3b048653-aaa9-485b-b0dd-d16e068230e9 and is obtainable
     * with the getPiece or getPieceDetail function
     */
    public $pieceId;

    public function getRequestString() {
        return 'd-get-piece-events';
    }
}
