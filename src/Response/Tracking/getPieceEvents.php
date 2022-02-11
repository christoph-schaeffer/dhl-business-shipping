<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceEvent;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class getPieceEvents
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * @TODO description
 */
class getPieceEvents extends AbstractTrackingResponse {

    /** @var string */
    public $requestId;
    /** @var string */
    public $code;
    /** @var PieceEvent[] */
    public $pieceEventList = [];

    /**
     * @param Request\Tracking\getPieceEvents $request
     * @param \SimpleXMLElement $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     */
    public function __construct(Request\Tracking\getPieceEvents $request, \SimpleXMLElement $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);
        if(isset($rawResponse->data)):
            $rawEventList = $rawResponse->data;
            foreach($rawEventList as $rawEvent):
                $this->pieceEventList[] = new PieceEvent($rawEvent);
            endforeach;
        endif;
    }


}
