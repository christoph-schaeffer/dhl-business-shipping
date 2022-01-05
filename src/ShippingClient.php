<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\ShippingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Soap;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\Sanitizer;

/**
 * Class ShippingClient
 * @package ChristophSchaeffer\Dhl\BusinessShipping
 *
 * This class is used as an abstraction layer for the business shipping soap api. Please use
 */
class ShippingClient {

    /**
     * Major Release of the shipping api this package is developed for
     */
    const MAJOR_RELEASE = 3;
    /**
     * Minor Release of the shipping this package is developed for
     */
    const MINOR_RELEASE = 1;

    /**
     * @var Soap
     */
    private $soap;

    /**
     * @var string
     *
     * The clients language for status messages
     */
    private $languageLocale;

    /**
     * @param ShippingClientCredentials $credentials
     * @param bool                      $isSandbox
     * @param string                    $languageLocale
     * @param \SoapClient               $soap // dependency injection
     *
     * @throws \SoapFault
     *
     * Client constructor.
     */
    public function __construct(ShippingClientCredentials $credentials, $isSandbox = FALSE,
                                                          $languageLocale = MultiClient::LANGUAGE_LOCALE_GERMAN_DE, $soap = NULL) {

        $this->languageLocale = $languageLocale;

        if(empty($soap))
            $this->soap = new Soap($credentials->appID, $credentials->apiToken, $credentials->login, $credentials->password, $isSandbox);
        else
            $this->soap = $soap;
    }

    /**
     * @param Request\createShipmentOrder $request
     *
     * @return Response\createShipmentOrder
     *
     * With this operation creates shipments for DHL Paket including the relevant shipping documents.
     */
    public function createShipmentOrder(Request\createShipmentOrder $request) {
        $request = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('createShipmentOrder', $request);

        return new Response\createShipmentOrder($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\deleteShipmentOrder $request
     *
     * @return Response\deleteShipmentOrder
     *
     * This operation cancels earlier created shipments. However, this will only work for shipments for that you
     * haven't called the doManifest function. Also keep in mind that if not set otherwise in the
     * "Geschäftskundenportal" there will be an automatic doManifest call on all open shipments at 6 pm every day.
     */
    public function deleteShipmentOrder(Request\deleteShipmentOrder $request) {
        $request = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('deleteShipmentOrder', $request);

        return new Response\deleteShipmentOrder($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\doManifest $request
     *
     * @return Response\doManifest
     *
     * With this operation a end-of-day closing for up to 30 previously created shipments can be carried out. Please
     * keep in mind, that once you have called this function for a shipment order it can't be canceled anymore.
     */
    public function doManifest(Request\doManifest $request) {
        $request = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('doManifest', $request);

        return new Response\doManifest($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\getExportDoc $request
     *
     * @return Response\getExportDoc
     *
     * This operation hands back export documents for previously created shipments.
     */
    public function getExportDoc(Request\getExportDoc $request) {
        $request = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('getExportDoc', $request);

        return new Response\getExportDoc($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\getLabel $request
     *
     * @return Response\getLabel
     *
     * This operation hands back the shipping label for previously created shipments.
     */
    public function getLabel(Request\getLabel $request) {
        $request = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('getLabel', $request);

        return new Response\getLabel($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\getManifest $request
     *
     * @return Response\getManifest
     *
     * With this operation end-of-day reports are available for a specific day or period.
     */
    public function getManifest(Request\getManifest $request) {
        $request = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('getManifest', $request);

        return new Response\getManifest($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\getVersion $request
     *
     * @return Response\getVersion
     *
     * With this operation the latest version available on the web can be queried.
     */
    public function getVersion(Request\getVersion $request) {
        $request = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('getVersion', $request);

        return new Response\getVersion($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\updateShipmentOrder $request
     *
     * @return Response\updateShipmentOrder
     *
     * With this operation shipping documents are updated for previously created shipments. The update automatically
     * performs a cancellation and creating of a shipment. However, this will only work for shipments for that you
     * haven't called the doManifest function. Also keep in mind that if not set otherwise in the
     * "Geschäftskundenportal" there will be an automatic doManifest call on all open shipments at 6 pm every day.
     */
    public function updateShipmentOrder(Request\updateShipmentOrder $request) {
        $request = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('updateShipmentOrder', $request);

        return new Response\updateShipmentOrder($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\validateShipment $request
     *
     * @return Response\validateShipment
     *
     * With this operation the data for a shipment can be validated before a shipment label and tracking number will be
     * created.
     */
    public function validateShipment(Request\validateShipment $request) {
        $request = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('validateShipment', $request);

        return new Response\validateShipment($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param AbstractRequest $request
     *
     * @return AbstractRequest
     *
     * This is an internal function to sanitize and convert data objects for SOAP
     */
    private function sanitizeRequest(AbstractRequest $request) {
        Sanitizer::sanitizeObjectRecursive($request);
        Sanitizer::convertBooleanToIntegerObjectRecursive($request);
        Sanitizer::convertFloatToStringObjectRecursive($request);

        return $request;
    }
}
