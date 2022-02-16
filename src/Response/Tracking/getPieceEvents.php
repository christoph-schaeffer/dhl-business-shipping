<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlXmlParseException;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceEvent;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class getPieceEvents
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 */
class getPieceEvents extends AbstractTrackingResponse {

    /**
     * @var PieceEvent[]
     *
     * This is where the piece event data is stored, please use this array to obtain the data you need
     */
    public $pieceEventList = [];

    /**
     * @param Request\Tracking\getPieceEvents $request
     * @param \SimpleXMLElement $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     * @throws DhlXmlParseException
     */
    public function __construct(Request\Tracking\getPieceEvents $request, \SimpleXMLElement $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);

        if (isset($rawResponse->data)):
            $rawEventList = $rawResponse->data;
            foreach ($rawEventList as $rawEvent):
                $this->pieceEventList[] = new PieceEvent($rawEvent);
            endforeach;
        endif;
    }
}
