<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlXmlParseException;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceShipment;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class getPieceDetail
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 */
class getPieceDetail extends AbstractTrackingResponse {

    /**
     * @var PieceShipment
     *
     * This is where the tracking data is stored, please use this object to obtain the data you need
     */
    public $pieceShipment;

    /**
     * @param Request\Tracking\getPieceDetail $request
     * @param \SimpleXMLElement $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     * @throws DhlXmlParseException
     */
    public function __construct(Request\Tracking\getPieceDetail $request, \SimpleXMLElement $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);

        $this->pieceShipment = new PieceShipment($rawResponse->data);
    }
}
