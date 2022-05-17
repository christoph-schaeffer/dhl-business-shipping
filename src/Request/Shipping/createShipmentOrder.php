<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractShippingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder;

/**
 * Class createShipmentOrder
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * This operation creates shipments for "DHL Paket" including the relevant shipping documents.
 * It will return the shipment number along with a shipping label which can be printed.
 */
class createShipmentOrder extends AbstractShippingRequest {

    /**
     * @var ShipmentOrder[]
     *
     * ShipmentOrder is the highest parent element that contains all data with respect to one shipment order. However
     * you can send up to 30 shipment orders in a single request
     */
    public $ShipmentOrder;

    /**
     * @var bool
     *
     * Optional
     *
     * Shipment label and return label will be printed together.
     */
    public $combinedPrinting = FALSE;

    /**
     * @var string
     *
     * Optional
     *
     * Choose beetween multiple user groups.
     * (Default=STANDARD_GRUPPENPROFIL)
     */
    public $groupProfileName = 'STANDARD_GRUPPENPROFIL';

    /**
     * @var string
     *
     * Optional
     *
     * Choose the label output format.
     * 910-300-700 (default)
     */
    public $labelFormat;

    /**
     * @var string
     *
     * Optional
     *
     * Choose the label output format.
     * 910-300-700 (default)
     */
    public $labelFormatRetoure;

    /**
     * @var string
     *
     * Optional
     *
     * Dial to determine label ouput format. This includes the retoure label output format. Possible values are:
     * 'URL' : Returns URLs to download PDF files containing the labels.
     * 'B64' : Returns shipment labels as base64encoded binary data
     * 'ZPL2': Returns shipment labels as Zebra Programming Language (V2) binary data. Only works with printers made by
     *         the printer manufacturer Zebra. When used, the retoure label will be returned as base64
     */
    public $labelResponseType = self::LABEL_RESPONSE_TYPE_URL;

    /**
     * @param ShipmentOrder[] $shipmentOrders
     *
     * createShipmentOrder constructor.
     */
    public function __construct(array $shipmentOrders) {
        parent::__construct();
        $this->ShipmentOrder = $shipmentOrders;
    }
}