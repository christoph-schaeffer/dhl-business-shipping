<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;

/**
 * Class getPieceEvents
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * The getPieceEvents functions supplies the shipment progress, comprising a shipment's individual events.
 *
 * For a successful call, this function requires the piece-id attribute from the getPiece/getPieceDetail call.
 * As a result, this function can only ever be used in combination with a preceding function call for the shipment
 * status getPiece/getPieceDetail. Since only one piece-id can ever be transferred, only one route for a shipment is
 * ever retrieved.
 */
class getPieceEvents extends AbstractTrackingRequest {

    /**
     * @var string
     *
     * Unique piece id. not to be confused with the tracking number ("Sendungsnummer") of the shipment you want to get data of.
     * This is not the tracking number. A piece id looks like this: 3b048653-aaa9-485b-b0dd-d16e068230e9 and is obtainable
     * with the getPiece or getPieceDetail function
     */
    public $pieceId;

    public function getRequestString() {
        return 'd-get-piece-events';
    }
}
