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
 *
 * !!! IMPORTANT INFO !!!
 * This function is disabled in sandbox mode. No idea why dhl decided that ¯\_(ツ)_/¯
 *
 * It is highly recommended to just use getPiece or getPieceDetail, as they do the same but with more information.
 *
 * The getStatusForPublicUser function provides information in the way it is shown currently in the DHL shipment
 * tracking area for everyone.
 */
class getStatusForPublicUser extends AbstractTrackingResponse {


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
     *
     *
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
        $this->code = XmlParser::nullableStringTypeCast('int', $this->code);

        if(isset($rawResponse->data) && isset($rawResponse->data->data)):
            $rawPieceStatusPublicList = $rawResponse->data->data;
            foreach ($rawPieceStatusPublicList as $rawPieceStatusPublic):
                $this->pieceStatusPublicList[] = new PieceStatusPublic($rawPieceStatusPublic);
            endforeach;
        endif;
    }

    /**
     * @return bool
     */
    public function hasNoErrors() {
        foreach($this->pieceStatusPublicList as $piece):
            if($piece->errorStatus !== 0):
                return false;
            endif;
        endforeach;

        return parent::hasNoErrors();
    }

}
