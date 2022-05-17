<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\ShippingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Soap;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractShippingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\Sanitizer;

/**
 * Class ShippingClient
 * @package ChristophSchaeffer\Dhl\BusinessShipping
 *
 * This class is used as an abstraction layer for the business shipping soap api. Please use
 */
class ShippingClient {

    const LABEL_FORMAT_WARENPOST      = '100x70mm';   // 100 x  70 mm (+ second page for international shipments; "Customs Declaration")
    const LABEL_FORMAT_910_300_300    = '910-300-300';// 105 x 148 mm
    const LABEL_FORMAT_910_300_300_oZ = '910-300-300-oz';
    const LABEL_FORMAT_910_300_400    = '910-300-400';// 103 x 150 mm
    const LABEL_FORMAT_910_300_410    = '910-300-400';
    const LABEL_FORMAT_910_300_600    = '910-300-600';// 103 x 199 mm
    const LABEL_FORMAT_910_300_610    = '910-300-600';
    const LABEL_FORMAT_910_300_700    = '910-300-700';// 105 x 205 mm
    const LABEL_FORMAT_910_300_700_oZ = '910-300-700-oz';
    const LABEL_FORMAT_910_300_710    = '910-300-710';// 105 x 208 mm
    const LABEL_FORMAT_A4             = 'A4';         // 210 x 297 mm

    const LABEL_RESPONSE_TYPE_BASE64                       = 'B64';
    const LABEL_RESPONSE_TYPE_URL                          = 'URL';
    const LABEL_RESPONSE_TYPE_ZEBRA_PROGRAMMING_LANGUAGE_2 = 'ZPL2';

    /**
     * Major Release of the shipping api this package is developed for
     */
    const MAJOR_RELEASE = 3;
    /**
     * Minor Release of the shipping this package is developed for
     */
    const MINOR_RELEASE = 2;

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
     * @param bool $isSandbox
     * @param string $languageLocale
     * @param \SoapClient $soap // dependency injection
     *
     * @throws \SoapFault
     *
     * Client constructor.
     */
    public function __construct(ShippingClientCredentials $credentials, $isSandbox = FALSE,
                                                          $languageLocale = MultiClient::LANGUAGE_LOCALE_GERMAN_DE, $soap = NULL) {

        $this->languageLocale = $languageLocale;

        if (empty($soap))
            $this->soap = new Soap($credentials->appID, $credentials->apiToken, $credentials->login, $credentials->password, $isSandbox);
        else
            $this->soap = $soap;
    }

    /**
     * @param Request\Shipping\createShipmentOrder $request
     *
     * @return Response\Shipping\createShipmentOrder
     *
     * With this operation creates shipments for DHL Paket including the relevant shipping documents.
     */
    public function createShipmentOrder(Request\Shipping\createShipmentOrder $request) {
        $request      = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('createShipmentOrder', $request);

        return new Response\Shipping\createShipmentOrder($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\Shipping\deleteShipmentOrder $request
     *
     * @return Response\Shipping\deleteShipmentOrder
     *
     * This operation cancels earlier created shipments. However, this will only work for shipments for that you
     * haven't called the doManifest function. Also keep in mind that if not set otherwise in the
     * "Geschäftskundenportal" there will be an automatic doManifest call on all open shipments at 6 pm every day.
     */
    public function deleteShipmentOrder(Request\Shipping\deleteShipmentOrder $request) {
        $request      = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('deleteShipmentOrder', $request);

        return new Response\Shipping\deleteShipmentOrder($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\Shipping\doManifest $request
     *
     * @return Response\Shipping\doManifest
     *
     * With this operation a end-of-day closing for up to 30 previously created shipments can be carried out. Please
     * keep in mind, that once you have called this function for a shipment order it can't be canceled anymore.
     */
    public function doManifest(Request\Shipping\doManifest $request) {
        $request      = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('doManifest', $request);

        return new Response\Shipping\doManifest($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\Shipping\getExportDoc $request
     *
     * @return Response\Shipping\getExportDoc
     *
     * This operation hands back export documents for previously created shipments.
     */
    public function getExportDoc(Request\Shipping\getExportDoc $request) {
        $request      = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('getExportDoc', $request);

        return new Response\Shipping\getExportDoc($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\Shipping\getLabel $request
     *
     * @return Response\Shipping\getLabel
     *
     * This operation hands back the shipping label for previously created shipments.
     */
    public function getLabel(Request\Shipping\getLabel $request) {
        $request      = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('getLabel', $request);

        return new Response\Shipping\getLabel($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\Shipping\getManifest $request
     *
     * @return Response\Shipping\getManifest
     *
     * With this operation end-of-day reports are available for a specific day or period.
     */
    public function getManifest(Request\Shipping\getManifest $request) {
        $request      = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('getManifest', $request);

        return new Response\Shipping\getManifest($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\Shipping\getVersion $request
     *
     * @return Response\Shipping\getVersion
     *
     * With this operation the latest version available on the web can be queried.
     */
    public function getVersion(Request\Shipping\getVersion $request) {
        $request      = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('getVersion', $request);

        return new Response\Shipping\getVersion($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\Shipping\updateShipmentOrder $request
     *
     * @return Response\Shipping\updateShipmentOrder
     *
     * With this operation shipping documents are updated for previously created shipments. The update automatically
     * performs a cancellation and creating of a shipment. However, this will only work for shipments for that you
     * haven't called the doManifest function. Also keep in mind that if not set otherwise in the
     * "Geschäftskundenportal" there will be an automatic doManifest call on all open shipments at 6 pm every day.
     */
    public function updateShipmentOrder(Request\Shipping\updateShipmentOrder $request) {
        $request      = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('updateShipmentOrder', $request);

        return new Response\Shipping\updateShipmentOrder($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param Request\Shipping\validateShipment $request
     *
     * @return Response\Shipping\validateShipment
     *
     * With this operation the data for a shipment can be validated before a shipment label and tracking number will be
     * created.
     */
    public function validateShipment(Request\Shipping\validateShipment $request) {
        $request      = $this->sanitizeRequest($request);
        $soapResponse = $this->soap->callSoapFunction('validateShipment', $request);

        return new Response\Shipping\validateShipment($request, $soapResponse, $this->soap->getLastSoapXMLRequest(),
            $this->languageLocale);
    }

    /**
     * @param AbstractShippingRequest $request
     *
     * @return AbstractShippingRequest
     *
     * This is an internal function to sanitize and convert data objects for SOAP
     */
    private function sanitizeRequest(AbstractShippingRequest $request) {
        Sanitizer::sanitizeObjectRecursive($request);
        Sanitizer::convertBooleanToIntegerObjectRecursive($request);
        Sanitizer::convertFloatToStringObjectRecursive($request);

        return $request;
    }
}
