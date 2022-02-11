<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceStatusPublic;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class getStatusForPublicUser
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * @TODO description
 */
class getStatusForPublicUser extends AbstractTrackingResponse {

    /** @var string */
    public $code;
    /** @var string */
    public $_pieceCode;
    /** @var string */
    public $_zipCode;
    /** @var PieceStatusPublic[] */
    public $pieceStatusPublicList = [];

    /**
     * @param Request\Tracking\getStatusForPublicUser $request
     * @param \SimpleXMLElement $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     */
    public function __construct(Request\Tracking\getStatusForPublicUser $request, \SimpleXMLElement $rawResponse, $rawRequest, $languageLocale)
    {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);
        if(isset($rawResponse->data) && isset($rawResponse->data->data)) {
            $rawPieceStatusPublicList = $rawResponse->data->data;
            foreach ($rawPieceStatusPublicList as $rawPieceStatusPublic) {
                $this->pieceStatusPublicList[] = new PieceStatusPublic($rawPieceStatusPublic);
            }
        }
    }


}
