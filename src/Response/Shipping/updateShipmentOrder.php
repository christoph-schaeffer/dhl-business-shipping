<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractShippingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping;

/**
 * Class updateShipmentOrder
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * With this operation shipping documents are updated for previously created shipments. The update automatically
 * performs a cancellation and creating of a shipment. However, this will only work for shipments for that you
 * haven't called the doManifest function. Also keep in mind that if not set otherwise in the
 * "Geschäftskundenportal" there will be an automatic doManifest call on all open shipments at 6 pm every day.
 */
class updateShipmentOrder extends AbstractShippingResponse {

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Data\LabelData
     *
     * This object contains the label data of the updated shipmentOrder
     */
    public $LabelData;

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\updateShipmentOrder
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\updateShipmentOrder $request
     * @param object                      $rawResponse
     * @param string                      $rawRequest
     * @param string                      $languageLocale
     *
     * updateShipmentOrder constructor.
     */
    public function __construct(Request\Shipping\updateShipmentOrder $request, $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);

        if(property_exists($rawResponse, 'LabelData'))
            $this->LabelData = new Shipping\Data\LabelData($languageLocale, $rawResponse->LabelData);
    }

    /**
     * @return bool
     *
     * Checks if the status array of the response and the label data object only contains one status,
     * which is the success status.
     */
    public function hasNoErrors() {
        if(!parent::hasNoErrors())
            return FALSE;

        if(empty($this->LabelData) || empty($this->LabelData->Status))
            return FALSE;

        $statusArray = $this->LabelData->Status;
        if(count($statusArray) !== 1 || !$this->firstStatusIsSuccess($statusArray))
            return FALSE;

        return TRUE;
    }
}