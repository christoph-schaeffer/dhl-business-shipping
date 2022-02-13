<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlXmlParseException;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceShipment;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class getPiece
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * The getPiece function returns the current shipping status of one or more shipments. In contrast to the query
 * from the DHL shipment tracking section for everyone, this function provides more status data that must only be used
 * for business-internal evaluations.
 *
 * The function can be called with a shipment number, a shipment reference or an order number for an individual pick-up
 * from the pick-up portal.
 */
class getPiece extends AbstractTrackingResponse {

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
     * @var PieceShipment
     *
     * This is where the tracking data is stored, please use this object to obtain the data you need
     */
    public $pieceShipment;

    /**
     * @param Request\Tracking\getPiece $request
     * @param \SimpleXMLElement $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     * @throws DhlXmlParseException
     */
    public function __construct(Request\Tracking\getPiece $request, \SimpleXMLElement $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);
        $this->code = XmlParser::nullableStringTypeCast('int', $this->code);

        $this->pieceShipment = new PieceShipment($rawResponse->data);
    }

    /**
     * @return bool
     */
    public function hasNoErrors() {
        return $this->pieceShipment->errorStatus === 0 && parent::hasNoErrors();
    }
}
