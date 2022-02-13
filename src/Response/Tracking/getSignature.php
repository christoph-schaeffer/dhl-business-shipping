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
