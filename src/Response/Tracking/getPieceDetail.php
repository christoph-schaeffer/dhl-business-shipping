<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlXmlParseException;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceShipment;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class getPieceDetail
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 */
class getPieceDetail extends AbstractTrackingResponse {

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
     * @var string
     *
     * Used for error messages. This is null when there is no error. However, please use the hasNoErrors functions in the
     * response object for error checking.
     */
    public $error;
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
        $this->code = XmlParser::nullableStringTypeCast('int', $this->code);

        $this->pieceShipment = new PieceShipment($rawResponse->data);
    }

    /**
     * @return bool
     */
    public function hasNoErrors() {
        return $this->pieceShipment->errorStatus === 0 && $this->pieceShipment->pieceStatus === null && $this->code === 0 && empty($this->error) && parent::hasNoErrors();
    }

}
