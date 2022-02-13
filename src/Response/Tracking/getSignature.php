<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlXmlParseException;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\Signature;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

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
class getSignature extends AbstractTrackingResponse {

    /**
     * @var string
     *
     * The request id. Example: 229fdf4c-6255-4cf4-947c-8441a85baaf9
     */
    public $requestId;
    /**
     * @var int
     *
     * Error status code for the current request
     *
     * For more information check the following url (you need to be authenticated on entwickler.dhl.de)
     * https://entwickler.dhl.de/group/ep/wsapis/sendungsverfolgung/allgemeinefehlerhandhabung
     *
     * 0 = successful
     */
    public $code;
    /**
     * @var Signature
     *
     * This is where the signature data is stored, please use this object to obtain the data you need
     */
    public $signature;

    /**
     * @param Request\Tracking\getSignature $request
     * @param \SimpleXMLElement $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     * @throws DhlXmlParseException
     */
    public function __construct(Request\Tracking\getSignature $request, \SimpleXMLElement $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);
        $this->code = XmlParser::nullableStringTypeCast('int', $this->code);

        $this->signature = new Signature($rawResponse->data);
    }

}
