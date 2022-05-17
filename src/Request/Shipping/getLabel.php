<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractShippingRequest;

/**
 * Class getLabel
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * This operation hands back the shipping label for previously created shipments.
 */
class getLabel extends AbstractShippingRequest {

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
     * @var string[]
     *
     * Min length: 1
     * Max length: 39(per entry)
     *
     * Can contain any DHL shipment number or multiple shipment numbers
     */
    public $shipmentNumber;

    /**
     * @param string[] $shipmentNumbers
     *
     * getLabel constructor.
     */
    public function __construct(array $shipmentNumbers) {
        parent::__construct();
        $this->shipmentNumber = $shipmentNumbers;
    }

}