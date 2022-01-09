<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceShipment;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class getPieceDetail
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * @TODO description
 */
class getPieceDetail extends AbstractTrackingResponse {

    public $requestId;
    public $code;
    /**
     * @var PieceShipment
     */
    public $pieceShipment;

    /**
     * @param AbstractTrackingRequest $request
     * @param \SimpleXMLElement $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     */
    public function __construct(AbstractTrackingRequest $request, \SimpleXMLElement $rawResponse, $rawRequest, $languageLocale)
    {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);
        $this->pieceShipment = XmlParser::mapXmlAttributesToObjectProperties($rawResponse->data, new PieceShipment($rawResponse->data));
    }


}
