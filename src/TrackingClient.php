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
class TrackingClient {

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
     * @param ?Rest $rest // dependency injection
     */
    public function __construct(TrackingClientCredentials $credentials, $isSandbox = FALSE,
                                                          $languageLocale = MultiClient::LANGUAGE_LOCALE_GERMAN_DE, $rest = null) {
        if (strlen($languageLocale) > 2) {
            $this->languageLocaleAlpha2 = CountryCodeConversion::languageLocaleToIsoAlpha2($languageLocale);
        } else {
            $this->languageLocaleAlpha2 = strtoupper($languageLocale);
        }

        if (empty($soap))
            $this->rest = new Rest($credentials->appID, $credentials->apiToken, $credentials->ztToken, $credentials->password, $isSandbox, $this->languageLocaleAlpha2);
        else
            $this->rest = $rest;
    }

    /**
     * @param Request\Tracking\getStatusForPublicUser $request
     *
     * @return Response\Tracking\getStatusForPublicUser
     *
     * @throws Exception\Tracking\DhlXmlParseException
     *
     * !!! IMPORTANT INFO !!!
     * This function is disabled in sandbox mode (said the support). No idea why dhl decided to do that ¯\_(ツ)_/¯
     *
     * It is highly recommended to just use getPiece or getPieceDetail, as they do the same but with more information.
     *
     * The getStatusForPublicUser function provides information in the way it is shown currently in the DHL shipment
     * tracking area for everyone.
     */
    public function getStatusForPublicUser(Request\Tracking\getStatusForPublicUser $request) {
        $request      = $this->sanitizeRequest($request);
        $restResponse = $this->rest->callFunction($request);

        return new Response\Tracking\getStatusForPublicUser($request, $restResponse, $this->rest->getLastRestXMLRequest(), $this->languageLocaleAlpha2);
    }

    /**
     * @param Request\Tracking\getPiece $request
     *
     * @return Response\Tracking\getPiece
     *
     * @throws Exception\Tracking\DhlXmlParseException
     *
     * The getPiece function returns the current shipping status of one or more shipments. In contrast to the query
     * from the DHL shipment tracking section for everyone, this function provides more status data that must only be used
     * for business-internal evaluations.
     *
     * The function can be called with a shipment number, a shipment reference or an order number for an individual pick-up
     * from the pick-up portal.
     */
    public function getPiece(Request\Tracking\getPiece $request) {
        $request      = $this->sanitizeRequest($request);
        $restResponse = $this->rest->callFunction($request);

        return new Response\Tracking\getPiece($request, $restResponse, $this->rest->getLastRestXMLRequest(), $this->languageLocaleAlpha2);
    }

    /**
     * @param Request\Tracking\getPieceEvents $request
     *
     * @return Response\Tracking\getPieceEvents
     *
     * @throws Exception\Tracking\DhlXmlParseException
     *
     * The getPieceEvents functions supplies the shipment progress, comprising a shipment's individual events.
     *
     * For a successful call, this function requires the piece-id attribute from the getPiece/getPieceDetail call.
     * As a result, this function can only ever be used in combination with a preceding function call for the shipment
     * status getPiece/getPieceDetail. Since only one piece-id can ever be transferred, only one route for a shipment is
     * ever retrieved.
     */
    public function getPieceEvents(Request\Tracking\getPieceEvents $request) {
        $request      = $this->sanitizeRequest($request);
        $restResponse = $this->rest->callFunction($request);

        return new Response\Tracking\getPieceEvents($request, $restResponse, $this->rest->getLastRestXMLRequest(), $this->languageLocaleAlpha2);
    }

    /**
     * @param Request\Tracking\getSignature $request
     *
     * @return Response\Tracking\getSignature
     *
     * @throws Exception\Tracking\DhlXmlParseException
     *
     * The getSignature function can retrieve the recipient's or substitute recipient's signature.
     * The signatures are also known as POD = Proof of Delivery.
     *
     * Of note here are the following particular features:
     * - Recipient signatures can only be retrieved via the shipment number.
     * - The signature itself is supplied in the form of a GIF image format. Since this image format contains binary data
     *   and this would cause problems being converted to XML, the data has been converted byte by byte into hexadecimal
     *   notation. However, this library converts it back to binary data after it has been received by DHL.
     * - Accesses typically put considerable strain on resources. It is recommended that signatures only be retrieved for
     *   delivered shipments (deliveryEventFlag = true) with dest-country = DE since signatures are only available in the
     *   system for these shipments. The signatures must only be retrieved once. If you have retrieved a signature, you
     *   should save this in your system in order to access it again later.
     */
    public function getSignature(Request\Tracking\getSignature $request) {
        $request      = $this->sanitizeRequest($request);
        $restResponse = $this->rest->callFunction($request);

        return new Response\Tracking\getSignature($request, $restResponse, $this->rest->getLastRestXMLRequest(), $this->languageLocaleAlpha2);
    }

    /**
     * @param Request\Tracking\getPieceDetail $request
     *
     * @return Response\Tracking\getPieceDetail
     *
     * @throws Exception\Tracking\DhlXmlParseException
     *
     * The getPieceDetail function retrieves all information about a shipment via a query. This is done by combining the
     * query of the getPiece and getPieceEvents functions.
     *
     * The function can be called with a shipment number, a shipment reference or an order number for an individual pick-up
     * from the pick-up portal.
     */
    public function getPieceDetail(Request\Tracking\getPieceDetail $request) {
        $request      = $this->sanitizeRequest($request);
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
