<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\ShippingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\TrackingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\Tracking\getStatusForPublicUser;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking\PieceData;

/**
 * Class MultiClient
 * @package ChristophSchaeffer\Dhl\BusinessShipping
 *
 * This is the main class of this plugin, which is used to call function of the api.
 */
class MultiClient {

    const LANGUAGE_LOCALE_GERMAN_DE  = 'de_DE';
    const LANGUAGE_LOCALE_ENGLISH_GB = 'en_GB';

    /**
     * @var ShippingClient
     */
    private $shippingClient;

    /**
     * @var TrackingClient
     */
    private $trackingClient;

    /**
     * Client constructor.
     * @param ShippingClientCredentials $shippingCredentials
     * @param TrackingClientCredentials $trackingCredentials
     * @param null|bool $isSandbox
     * @param null|string $languageLocale
     * @param null|ShippingClient $shippingClient // dependency injection
     * @param null|TrackingClient $trackingClient // dependency injection
     * @throws \SoapFault
     */
    public function __construct(ShippingClientCredentials $shippingCredentials, TrackingClientCredentials $trackingCredentials, $isSandbox = FALSE,
                                                          $languageLocale = self::LANGUAGE_LOCALE_GERMAN_DE, $shippingClient = null, $trackingClient = null) {

        if (empty($shippingClient)) {
            $this->shippingClient = new ShippingClient($shippingCredentials, $isSandbox, $languageLocale);
        } else {
            $this->shippingClient = $shippingClient;
        }
        if (empty($trackingClient)) {
            $this->trackingClient = new TrackingClient($trackingCredentials, $isSandbox, $languageLocale);
        } else {
            $this->trackingClient = $trackingClient;
        }
    }

    /**
     * @param Request\Shipping\createShipmentOrder $request
     *
     * @return Response\Shipping\createShipmentOrder
     *
     * With this operation creates shipments for DHL Paket including the relevant shipping documents.
     */
    public function createShipmentOrder(Request\Shipping\createShipmentOrder $request) {
        return $this->shippingClient->createShipmentOrder($request);
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
        return $this->shippingClient->deleteShipmentOrder($request);
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
        return $this->shippingClient->doManifest($request);
    }

    /**
     * @param Request\Shipping\getExportDoc $request
     *
     * @return Response\Shipping\getExportDoc
     *
     * This operation hands back export documents for previously created shipments.
     */
    public function getExportDoc(Request\Shipping\getExportDoc $request) {
        return $this->shippingClient->getExportDoc($request);
    }

    /**
     * @param Request\Shipping\getLabel $request
     *
     * @return Response\Shipping\getLabel
     *
     * This operation hands back the shipping label for previously created shipments.
     */
    public function getLabel(Request\Shipping\getLabel $request) {
        return $this->shippingClient->getLabel($request);
    }

    /**
     * @param Request\Shipping\getManifest $request
     *
     * @return Response\Shipping\getManifest
     *
     * With this operation end-of-day reports are available for a specific day or period.
     */
    public function getManifest(Request\Shipping\getManifest $request) {
        return $this->shippingClient->getManifest($request);
    }

    /**
     * @param Request\Shipping\getVersion $request
     *
     * @return Response\Shipping\getVersion
     *
     * With this operation the latest version available on the web can be queried.
     */
    public function getVersion(Request\Shipping\getVersion $request) {
        return $this->shippingClient->getVersion($request);
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
        return $this->shippingClient->updateShipmentOrder($request);
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
        return $this->shippingClient->validateShipment($request);
    }

    /**
     * @param Request\Tracking\getStatusForPublicUser $request
     *
     * @return Response\Tracking\getStatusForPublicUser
     */
    public function getStatusForPublicUser(Request\Tracking\getStatusForPublicUser $request) {
        return $this->trackingClient->getStatusForPublicUser($request);
    }

}
