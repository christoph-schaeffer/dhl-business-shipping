<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;

/**
 * Class getSignature
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * The getSignature function can retrieve the recipient's or substitute recipient's signature.
 * The signatures are also known as POD = Proof of Delivery.
 *
 * Of note here are the following particular features:
 * - Recipient signatures can only be retrieved via the shipment number.
 * - The signature itself is supplied in the form of a GIF image format. Since this image format contains binary data
 *   and this would cause problems being converted to XML, the data has been converted byte by byte into hexadecimal
 *   notation. However, this library converts it back to binary data after it has been received by DHL.
 * - Accesses typically put considerable strain on resources. It is recommended that signatures only be retrieved for
 *   delivered shipments (deliveryEventFlag = true) with dest-country = DE since signatures are only available in the
 *   system for these shipments. The signatures must only be retrieved once. If you have retrieved a signature, you
 *   should save this in your system in order to access it again later.
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
