<?php


namespace ChristophSchaeffer\Dhl\BusinessShipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\TrackingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Rest;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\CountryCodeConversion;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\Sanitizer;

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
     * @param Request\Tracking\getStatusForPublicUser $request
     *
     * @return Response\Tracking\getStatusForPublicUser
     */
    public function getStatusForPublicUser(Request\Tracking\getStatusForPublicUser $request) {
        $request = $this->sanitizeRequest($request);
        $restResponse = $this->rest->callFunction($request);

        return new Response\Tracking\getStatusForPublicUser($request, $restResponse, $this->rest->getLastRestXMLRequest(), $this->languageLocaleAlpha2);
    }

    /**
     * @param Request\Tracking\getPieceDetail $request
     *
     * @return Response\Tracking\getPieceDetail
     */
    public function getPieceDetail(Request\Tracking\getPieceDetail $request) {
        $request = $this->sanitizeRequest($request);
        $restResponse = $this->rest->callFunction($request);

        return new Response\Tracking\getPieceDetail($request, $restResponse, $this->rest->getLastRestXMLRequest(), $this->languageLocaleAlpha2);
    }

    /**
     * @param AbstractTrackingRequest $request
     *
     * @return AbstractTrackingRequest
     *
     * This is an internal function to sanitize and convert data objects for REST
     */
    private function sanitizeRequest(AbstractTrackingRequest $request) {
        Sanitizer::sanitizeObjectRecursive($request);
        Sanitizer::convertFloatToStringObjectRecursive($request);

        return $request;
    }

}
