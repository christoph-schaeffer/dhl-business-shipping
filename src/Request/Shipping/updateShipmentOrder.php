<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractShippingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder;

/**
 * Class updateShipmentOrder
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * With this operation shipping documents are updated for previously created shipments. The update automatically
 * performs a cancellation and creating of a shipment. However, this will only work for shipments for that you
 * haven't called the doManifest function. Also keep in mind that if not set otherwise in the
 * "Geschäftskundenportal" there will be an automatic doManifest call on all open shipments at 6 pm every day.
 */
class updateShipmentOrder extends AbstractShippingRequest {

    const LABEL_FORMAT_910_300_600    = createShipmentOrder::LABEL_FORMAT_910_300_600;
    const LABEL_FORMAT_910_300_610    = createShipmentOrder::LABEL_FORMAT_910_300_610;
    const LABEL_FORMAT_910_300_700    = createShipmentOrder::LABEL_FORMAT_910_300_700;
    const LABEL_FORMAT_910_300_700_oZ = createShipmentOrder::LABEL_FORMAT_910_300_700_oZ;
    const LABEL_FORMAT_910_300_710    = createShipmentOrder::LABEL_FORMAT_910_300_710;
    const LABEL_FORMAT_A4             = createShipmentOrder::LABEL_FORMAT_A4;

    const LABEL_RESPONSE_TYPE_BASE64                       = createShipmentOrder::LABEL_RESPONSE_TYPE_BASE64;
    const LABEL_RESPONSE_TYPE_URL                          = createShipmentOrder::LABEL_RESPONSE_TYPE_URL;
    const LABEL_RESPONSE_TYPE_ZEBRA_PROGRAMMING_LANGUAGE_2 = createShipmentOrder::LABEL_RESPONSE_TYPE_ZEBRA_PROGRAMMING_LANGUAGE_2;

    /**
     * @var ShipmentOrder
     *
     * ShipmentOrder is the highest parent element that contains all data with respect to one shipment order.
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
     */
    public $groupProfileName = 'STANDARD_GRUPPENPROFIL';

    /**
     * @var string
     *
     * Optional
     *
     * Choose the label output format.
     * A4
     * 910-300-700 (default)
     * 910-300-700-oZ
     * 910-300-600
     * 910-300-610
     * 910-300-710
     */
    public $labelFormat;

    /**
     * @var string
     *
     * Optional
     *
     * Choose the label output format.
     * A4
     * 910-300-700 (default)
     * 910-300-700-oZ
     * 910-300-600
     * 910-300-610
     * 910-300-710
     */
    public $labelFormatRetoure;

    /**
     * @var string
     *
     * Dial to determine label ouput format. This includes the retoure label output format. Possible values are:
     * 'URL' : Returns URLs to download PDF files containing the labels.
     * 'B64' : Returns shipment labels as base64encoded binary data
     * 'ZPL2': Returns shipment labels as Zebra Programming Language (V2) binary data. Only works with printers made by
     *         the printer manufacturer Zebra. When used, the retoure label will be returned as base64
     */
    public $labelResponseType;

    /**
     * @var string
     *
     * Min length: 1
     * Max length: 39
     *
     * Can contain any DHL shipmentnumber
     */
    public $shipmentNumber;

    /**
     * @param string        $shipmentNumber
     * @param ShipmentOrder $shipmentOrder
     *
     * updateShipmentOrder constructor.
     */
    public function __construct($shipmentNumber, ShipmentOrder $shipmentOrder) {
        parent::__construct();
        $this->shipmentNumber = $shipmentNumber;
        $this->ShipmentOrder  = $shipmentOrder;
    }
}