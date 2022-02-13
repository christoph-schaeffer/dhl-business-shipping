<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;

/**
 * Class getPiece
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * The getPiece function returns the current shipping status of one or more shipments. In contrast to the query
 * from the DHL shipment tracking section for everyone, this function provides more status data that must only be used
 * for business-internal evaluations.
 *
 * The function can be called with a shipment number, a shipment reference or an order number for an individual pick-up
 * from the pick-up portal.
 */
class getPiece extends AbstractTrackingRequest {

    /**
     * @var string
     *
     * Only Required when pieceCustomerReference and tasOrderNo are empty
     *
     * Instead of the pieceCode you can also use the customer reference or tas order no of the shipment you want to get
     * data of
     *
     * The tracking number ("Sendungsnummer") of the shipment you want to get data of.
     */
    public $pieceCode;
    /**
     * @var string
     *
     * Only Required when pieceCode and tasOrderNo are empty
     *
     * Instead of the pieceCode or tasOrderNo you can use the customer reference of the shipment you want to get data of
     * , if you have filled that property when you generated the shipment label.
     */
    public $pieceCustomerReference;
    /**
     * @var string
     *
     * Only Required when pieceCode and pieceCustomerReference are empty
     *
     * Instead of the pieceCode or pieceCustomerReference you can use the tas order number of the shipment you want
     * to get data of.
     */
    public $tasOrderNo;

    public function getRequestString() {
        return 'd-get-piece';
    }
}
