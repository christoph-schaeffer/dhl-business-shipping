<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractShippingRequest;

/**
 * Class getExportDoc
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * This operation hands back export documents for previously created shipments.
 *
 */
class getExportDoc extends AbstractShippingRequest {

    const LABEL_RESPONSE_TYPE_BASE64 = createShipmentOrder::LABEL_RESPONSE_TYPE_BASE64;
    const LABEL_RESPONSE_TYPE_URL    = createShipmentOrder::LABEL_RESPONSE_TYPE_URL;

    /**
     * @var string
     *
     * Optional
     *
     * Dial to determine label ouput format. Possible values are:
     * 'URL' : Returns URLs to download PDF files containing the labels.
     * 'B64' : Returns shipment labels as base64encoded binary data
     */
    public $exportDocResponseType = self::LABEL_RESPONSE_TYPE_URL;

    /**
     * @var string[]
     *
     * Min length: 1(per entry)
     * Max length: 39(per entry)
     *
     * Can contain any DHL shipmentnumber
     */
    public $shipmentNumber;

    /**
     * @param string[] $shipmentNumbers
     *
     * getExportDoc constructor.
     */
    public function __construct(array $shipmentNumbers) {
        parent::__construct();
        $this->shipmentNumber = $shipmentNumbers;
    }

}