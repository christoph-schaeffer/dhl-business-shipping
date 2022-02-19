<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlXmlParseException;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\Signature;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class getSignature
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 */
class getSignature extends AbstractTrackingResponse {

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
        $this->checkForUnknownErrors($languageLocale);

        if(isset($rawResponse->data)):
            $this->signature = new Signature($rawResponse->data);
        endif;
    }
}
