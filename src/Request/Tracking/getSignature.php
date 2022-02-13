<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;

/**
 * Class getSignature
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 */
class getSignature extends AbstractTrackingRequest {

    /**
     * @var string
     *
     * The tracking number ("Sendungsnummer") of the shipment you want to get the signature of.
     */
    public $pieceCode;
    /**
     * @var string
     *
     * Optional
     *
     * A date as a formatted string. This acts as a filter.
     * Format: YYYY-MM-DD. e.g. 2022-02-22
     */
    public $dateFrom;
    /**
     * @var string
     *
     * Optional
     *
     * A date as a formatted string. This acts as a filter.
     * Format: YYYY-MM-DD. e.g. 2022-02-22
     */
    public $dateTo;

    public function getRequestString() {
        return 'd-get-signature';
    }
}
