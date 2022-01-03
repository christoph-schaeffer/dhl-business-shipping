<?php


namespace ChristophSchaeffer\Dhl\BusinessShipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking\PieceData;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking\RequestData;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\PieceStatusPublic;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\CountryCodeConversion;

/**
 * Class ShippingClient
 * @package ChristophSchaeffer\Dhl\BusinessShipping
 *
 * This class is used as an abstraction layer for the business shipping soap api. Please use
 */
class TrackingClient
{

    const LANGUAGE_LOCALE_ALPHA2_DE = 'DE';
    const LANGUAGE_LOCALE_ALPHA2_EN = 'EN';

    /**
     * @var string
     *
     * The clients language for status messages
     */
    private $languageLocaleAlpha2 = self::LANGUAGE_LOCALE_ALPHA2_DE;

    /**
     * TrackingClient constructor.
     * @param string $appID
     * @param string $apiToken
     * @param string $zTToken
     * @param string $password
     * @param false $isSandbox
     * @param string $languageLocale
     * @param ?Rest $rest
     */
    public function __construct($appID, $apiToken, $zTToken, $password, $isSandbox = FALSE,
                                $languageLocale = Client::LANGUAGE_LOCALE_GERMAN_DE, $rest = null)
    {
        if(strlen($languageLocale) > 2) {
            $this->languageLocaleAlpha2 = CountryCodeConversion::languageLocaleToIsoAlpha2($languageLocale);
        } else {
            $this->languageLocaleAlpha2 = strtoupper($languageLocale);
        }

        if(empty($soap))
            $this->rest = new Rest($appID, $apiToken, $zTToken, $password, $isSandbox, $this->languageLocaleAlpha2);
        else
            $this->rest = $rest;
    }

    /**
     * @param PieceData[] $pieces
     *
     * @return string //@TODO need response objects
     */
    public function getStatusForPublicUser($pieces) {
        $requestData = new RequestData();
        $requestData->request = RequestData::REQUEST_GET_STATUS_FOR_PUBLIC_USER;
        return $this->rest->callFunction($requestData, $pieces);
    }
}
