<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\ShippingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Soap;

/**
 * Class Client
 * @deprecated
 * @package ChristophSchaeffer\Dhl\BusinessShipping
 *
 * This class has been deprecated and will be removed soon. Please use either the MultiClient or ShippingClient please.
 */
class Client {

    /** @deprecated */
    const LANGUAGE_LOCALE_GERMAN_DE  = 'de_DE';
    /** @deprecated */
    const LANGUAGE_LOCALE_ENGLISH_GB = 'en_GB';
    /** @deprecated */
    const MAJOR_RELEASE = 3;
    /** @deprecated */
    const MINOR_RELEASE = 1;

    /**
     * @var Soap
     * @deprecated
     */
    public $soap;

    private $shippingClient;

    /**
     * @deprecated
     *
     * This class has been deprecated and will be removed soon. Please use either the MultiClient or ShippingClient please.
     *
     * @param string      $appID
     * @param string      $apiToken
     * @param string      $login
     * @param string      $password
     * @param bool        $isSandbox
     * @param string      $languageLocale
     * @param \SoapClient $soap
     *
     * @throws \SoapFault
     *
     * Client constructor.
     */
    public function __construct($appID, $apiToken, $login = '', $password = '', $isSandbox = FALSE,
                                $languageLocale = self::LANGUAGE_LOCALE_GERMAN_DE, $soap = NULL) {

        $credentials = new ShippingClientCredentials($appID, $apiToken, $login, $password);
        $this->shippingClient = new ShippingClient($credentials, $isSandbox, $languageLocale, $soap);
    }

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\createShipmentOrder $request
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\createShipmentOrder
     *
     * With this operation creates shipments for DHL Paket including the relevant shipping documents.
     *@deprecated
     *
     * This class has been deprecated and will be removed soon. Please use either the MultiClient or ShippingClient please.
     *
     *
     */
    public function createShipmentOrder(Request\Shipping\createShipmentOrder $request) {
        $this->shippingClient->createShipmentOrder($request);
    }

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\deleteShipmentOrder $request
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\deleteShipmentOrder
     *
     * This operation cancels earlier created shipments. However, this will only work for shipments for that you
     * haven't called the doManifest function. Also keep in mind that if not set otherwise in the
     * "Geschäftskundenportal" there will be an automatic doManifest call on all open shipments at 6 pm every day.
     *@deprecated
     *
     * This class has been deprecated and will be removed soon. Please use either the MultiClient or ShippingClient please.
     *
     *
     */
    public function deleteShipmentOrder(Request\Shipping\deleteShipmentOrder $request) {
        $this->shippingClient->deleteShipmentOrder($request);
    }

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\doManifest $request
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\doManifest
     *
     * With this operation a end-of-day closing for up to 30 previously created shipments can be carried out. Please
     * keep in mind, that once you have called this function for a shipment order it can't be canceled anymore.
     *@deprecated
     *
     * This class has been deprecated and will be removed soon. Please use either the MultiClient or ShippingClient please.
     *
     *
     */
    public function doManifest(Request\Shipping\doManifest $request) {
        $this->shippingClient->doManifest($request);
    }

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getExportDoc $request
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\getExportDoc
     *
     * This operation hands back export documents for previously created shipments.
     * @deprecated
     *
     * This class has been deprecated and will be removed soon. Please use either the MultiClient or ShippingClient please.
     *
     *
     */
    public function getExportDoc(Request\Shipping\getExportDoc $request) {
        $this->shippingClient->getExportDoc($request);
    }

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getLabel $request
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\getLabel
     *
     * This operation hands back the shipping label for previously created shipments.
     * @deprecated
     *
     * This class has been deprecated and will be removed soon. Please use either the MultiClient or ShippingClient please.
     *
     *
     */
    public function getLabel(Request\Shipping\getLabel $request) {
        $this->shippingClient->getLabel($request);
    }

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getManifest $request
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\getManifest
     *
     * With this operation end-of-day reports are available for a specific day or period.
     * @deprecated
     *
     * This class has been deprecated and will be removed soon. Please use either the MultiClient or ShippingClient please.
     *
     *
     */
    public function getManifest(Request\Shipping\getManifest $request) {
        $this->shippingClient->getManifest($request);
    }

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getVersion $request
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\getVersion
     *
     * With this operation the latest version available on the web can be queried.
     * @deprecated
     *
     * This class has been deprecated and will be removed soon. Please use either the MultiClient or ShippingClient please.
     *
     *
     */
    public function getVersion(Request\Shipping\getVersion $request) {
        $this->shippingClient->getVersion($request);
    }

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\updateShipmentOrder $request
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\updateShipmentOrder
     *
     * With this operation shipping documents are updated for previously created shipments. The update automatically
     * performs a cancellation and creating of a shipment. However, this will only work for shipments for that you
     * haven't called the doManifest function. Also keep in mind that if not set otherwise in the
     * "Geschäftskundenportal" there will be an automatic doManifest call on all open shipments at 6 pm every day.
     *@deprecated
     *
     * This class has been deprecated and will be removed soon. Please use either the MultiClient or ShippingClient please.
     *
     *
     */
    public function updateShipmentOrder(Request\Shipping\updateShipmentOrder $request) {
        $this->shippingClient->updateShipmentOrder($request);
    }

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\validateShipment $request
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\validateShipment
     *
     * With this operation the data for a shipment can be validated before a shipment label and tracking number will be
     * created.
     *@deprecated
     *
     * This class has been deprecated and will be removed soon. Please use either the MultiClient or ShippingClient please.
     *
     *
     */
    public function validateShipment(Request\Shipping\validateShipment $request) {
        $this->shippingClient->validateShipment($request);
    }

}
