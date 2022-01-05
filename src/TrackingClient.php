<?php


namespace ChristophSchaeffer\Dhl\BusinessShipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\TrackingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Rest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking\PieceData;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking\RequestData;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\CountryCodeConversion;

/**
 * Class ShippingClient
 * @package ChristophSchaeffer\Dhl\BusinessShipping
 *
 * This class is used as an abstraction layer for the business shipping soap api. Please use
 */
class TrackingClient
{

    /**
     * Major Release of the tracking api this package is developed for
     */
    const MAJOR_RELEASE = 1;
    /**
     * Minor Release of the tracking api this package is developed for
     */
    const MINOR_RELEASE = 0;

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
     * @param TrackingClientCredentials $credentials
     * @param false $isSandbox
     * @param string $languageLocale
     * @param ?Rest $rest  // dependency injection
     */
    public function __construct(TrackingClientCredentials $credentials, $isSandbox = FALSE,
                                                          $languageLocale = MultiClient::LANGUAGE_LOCALE_GERMAN_DE, $rest = null)
    {
        if(strlen($languageLocale) > 2) {
            $this->languageLocaleAlpha2 = CountryCodeConversion::languageLocaleToIsoAlpha2($languageLocale);
        } else {
            $this->languageLocaleAlpha2 = strtoupper($languageLocale);
        }

        if(empty($soap))
            $this->rest = new Rest($credentials->appID, $credentials->apiToken, $credentials->ztToken, $credentials->password, $isSandbox, $this->languageLocaleAlpha2);
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
