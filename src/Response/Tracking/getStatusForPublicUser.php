<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceEvent;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class getStatusForPublicUser
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * @TODO description
 */
class getStatusForPublicUser extends AbstractTrackingResponse {

    public $code;
    public $_pieceCode;
    public $_zipCode;
    public $pieceStatusList = [];

    /**
     * @param AbstractTrackingRequest $request
     * @param \SimpleXMLElement $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     */
    public function __construct(AbstractTrackingRequest $request, \SimpleXMLElement $rawResponse, $rawRequest, $languageLocale)
    {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);
        $rawEventList = $rawResponse->data->data;
        foreach($rawEventList as $rawEvent) {
            $this->pieceEventList[] = XmlParser::mapXmlAttributesToObjectProperties($rawEvent, new PieceEvent());
        }
    }


}
