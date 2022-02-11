<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceShipment;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class getPieceDetail
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * @TODO description
 */
class getPieceDetail extends AbstractTrackingResponse {

    /** @var string */
    public $requestId;
    /** @var string */
    public $code;
    /** @var PieceShipment */
    public $pieceShipment;

    /**
     * @param Request\Tracking\getPieceDetail $request
     * @param \SimpleXMLElement $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     */
    public function __construct(Request\Tracking\getPieceDetail $request, \SimpleXMLElement $rawResponse, $rawRequest, $languageLocale)
    {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);
        $this->pieceShipment = new PieceShipment($rawResponse->data);
    }


}
