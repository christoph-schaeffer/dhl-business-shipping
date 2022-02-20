<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlXmlParseException;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceStatusPublic;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class getStatusForPublicUser
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 */
class getStatusForPublicUser extends AbstractTrackingResponse {

    /**
     * @var string
     *
     * Undocumented by DHL
     */
    public $_pieceCode;
    /**
     * @var string
     *
     * Undocumented by DHL
     */
    public $_zipCode;
    /**
     * @var PieceStatusPublic[]
     *
     * This is where the tracking data for each shipment you have queried is stored, please use this array to obtain the
     * data you need.
     */
    public $pieceStatusPublicList = [];

    /**
     * @param Request\Tracking\getStatusForPublicUser $request
     * @param \SimpleXMLElement $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     * @throws DhlXmlParseException
     */
    public function __construct(Request\Tracking\getStatusForPublicUser $request, \SimpleXMLElement $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);

        if (isset($rawResponse->data)):
            $rawPieceStatusPublicListObject = $rawResponse->data;
            XmlParser::mapXmlAttributesToObjectProperties($rawPieceStatusPublicListObject, $this);
            $this->code = XmlParser::nullableStringTypeCast('int', $this->code);
            $this->checkForUnknownErrors($languageLocale);

            if(isset($rawResponse->data->data)):
                $rawPieceStatusPublicList = $rawResponse->data->data;
                foreach ($rawPieceStatusPublicList as $rawPieceStatusPublic):
                    $this->pieceStatusPublicList[] = new PieceStatusPublic($rawPieceStatusPublic);
                endforeach;
            endif;
        endif;
    }
}
