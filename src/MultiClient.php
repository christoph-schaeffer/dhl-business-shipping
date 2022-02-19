<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\ShippingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\TrackingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Exception;

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
     *
     * @throws Exception\Tracking\DhlRestCurlException
     * @throws Exception\Tracking\DhlRestHttpException
     * @throws Exception\Tracking\DhlXmlParseException
     * @throws Exception\Tracking\DhlNotAvailableInSandbox
     *
     * !!! IMPORTANT INFO !!!
     * This function is disabled in sandbox mode (said the support). No idea why dhl decided to do that ¯\_(ツ)_/¯
     *
     * The getStatusForPublicUser function provides information in the way it is shown currently in the DHL shipment
     * tracking area for everyone. You can request all shipment numbers with this functions, even from shipments you did
     * not send or receive yourself.
     */
    public function getStatusForPublicUser(Request\Tracking\getStatusForPublicUser $request) {
        return $this->trackingClient->getStatusForPublicUser($request);
    }

    /**
     * @param Request\Tracking\getPieceDetail $request
     *
     * @return Response\Tracking\getPieceDetail
     *
     * @throws Exception\Tracking\DhlRestCurlException
     * @throws Exception\Tracking\DhlRestHttpException
     * @throws Exception\Tracking\DhlXmlParseException
     *
     * This function only works with shipments you have sent with the same business customer account as the zt token
     * credentials you use.
     *
     * The getPieceDetail function retrieves all information about a shipment via a query. This is done by combining the
     * query of the getPiece and getPieceEvents functions.
     *
     * The function can be called with a shipment number, a shipment reference or an order number for an individual pick-up
     * from the pick-up portal.
     */
    public function getPieceDetail(Request\Tracking\getPieceDetail $request) {
        return $this->trackingClient->getPieceDetail($request);
    }

    /**
     * @param Request\Tracking\getPiece $request
     *
     * @return Response\Tracking\getPiece
     *
     * @throws Exception\Tracking\DhlRestCurlException
     * @throws Exception\Tracking\DhlRestHttpException
     * @throws Exception\Tracking\DhlXmlParseException
     *
     * This function only works with shipments you have sent with the same business customer account as the zt token
     * credentials you use.
     *
     * The getPiece function returns the current shipping status of one or more shipments. In contrast to the query
     * from the DHL shipment tracking section for everyone, this function provides more status data that must only be used
     * for business-internal evaluations.
     *
     * The function can be called with a shipment number, a shipment reference or an order number for an individual pick-up
     * from the pick-up portal.
     */
    public function getPiece(Request\Tracking\getPiece $request) {
        return $this->trackingClient->getPiece($request);
    }

    /**
     * @param Request\Tracking\getPieceEvents $request
     *
     * @return Response\Tracking\getPieceEvents
     *
     * @throws Exception\Tracking\DhlRestCurlException
     * @throws Exception\Tracking\DhlRestHttpException
     * @throws Exception\Tracking\DhlXmlParseException
     *
     * This function only works with shipments you have sent with the same business customer account as the zt token
     * credentials you use.
     *
     * The getPieceEvents functions supplies the shipment progress, comprising a shipment's individual events.
     *
     * For a successful call, this function requires the piece-id attribute from the getPiece/getPieceDetail call.
     * As a result, this function can only ever be used in combination with a preceding function call for the shipment
     * status getPiece/getPieceDetail. Since only one piece-id can ever be transferred, only one route for a shipment is
     * ever retrieved.
     */
    public function getPieceEvents(Request\Tracking\getPieceEvents $request) {
        return $this->trackingClient->getPieceEvents($request);
    }

    /**
     * @param Request\Tracking\getSignature $request
     *
     * @return Response\Tracking\getSignature
     *
     * @throws Exception\Tracking\DhlRestCurlException
     * @throws Exception\Tracking\DhlRestHttpException
     * @throws Exception\Tracking\DhlXmlParseException
     *
     * This function only works with shipments you have sent with the same business customer account as the zt token
     * credentials you use.
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
        return $this->trackingClient->getSignature($request);
    }

}
