<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\ShippingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\TrackingClientCredentials;
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

        if(empty($shippingClient)) {
            $this->shippingClient = new ShippingClient($shippingCredentials, $isSandbox, $languageLocale);
        } else {
            $this->shippingClient = $shippingClient;
        }
        if(empty($trackingClient)) {
            $this->trackingClient = new TrackingClient($trackingCredentials, $isSandbox, $languageLocale);
        } else {
            $this->trackingClient = $trackingClient;
        }
    }

    /**
     * @param Request\createShipmentOrder $request
     *
     * @return Response\createShipmentOrder
     *
     * With this operation creates shipments for DHL Paket including the relevant shipping documents.
     */
    public function createShipmentOrder(Request\createShipmentOrder $request) {
        $this->shippingClient->createShipmentOrder($request);
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
        $this->shippingClient->deleteShipmentOrder($request);
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
        $this->shippingClient->doManifest($request);
    }

    /**
     * @param Request\getExportDoc $request
     *
     * @return Response\getExportDoc
     *
     * This operation hands back export documents for previously created shipments.
     */
    public function getExportDoc(Request\getExportDoc $request) {
        $this->shippingClient->getExportDoc($request);
    }

    /**
     * @param Request\getLabel $request
     *
     * @return Response\getLabel
     *
     * This operation hands back the shipping label for previously created shipments.
     */
    public function getLabel(Request\getLabel $request) {
        $this->shippingClient->getLabel($request);
    }

    /**
     * @param Request\getManifest $request
     *
     * @return Response\getManifest
     *
     * With this operation end-of-day reports are available for a specific day or period.
     */
    public function getManifest(Request\getManifest $request) {
        $this->shippingClient->getManifest($request);
    }

    /**
     * @param Request\getVersion $request
     *
     * @return Response\getVersion
     *
     * With this operation the latest version available on the web can be queried.
     */
    public function getVersion(Request\getVersion $request) {
        $this->shippingClient->getVersion($request);
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
        $this->shippingClient->updateShipmentOrder($request);
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
        $this->shippingClient->validateShipment($request);
    }

    /**
     * @param PieceData[] $pieces
     *
     * @return string //@TODO need response objects
     */
    public function getStatusForPublicUser($pieces) {
        $this->trackingClient->getStatusForPublicUser($pieces);
    }

}
