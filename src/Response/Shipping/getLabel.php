<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractShippingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping;

/**
 * Class getLabel
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * This operation hands back the shipping label for previously created shipments.
 */
class getLabel extends AbstractShippingResponse {

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Data\LabelData[]
     *
     * For every ShipmentNumber requested, one LabelData node is returned that contains the status of the label
     * retrieval operation and the URL for the label (if available).
     */
    public $LabelData;

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getLabel
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getLabel $request
     * @param object           $rawResponse
     * @param string           $rawRequest
     * @param string           $languageLocale
     *
     * getLabel constructor.
     */
    public function __construct(Request\Shipping\getLabel $request, $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);

        if(!property_exists($rawResponse, 'LabelData'))
            return;

        if(is_array($rawResponse->LabelData)):
            $this->LabelData = $this->mapMultipleLabelData($rawResponse->LabelData, $languageLocale);
        elseif(!empty($rawResponse->LabelData)):
            $this->LabelData[] = new Shipping\Data\LabelData($languageLocale, $rawResponse->LabelData);
        endif;
    }

    /**
     * @return bool
     *
     * Checks if the status array of the response and each label data object only contains one status,
     * which is the success status.
     */
    public function hasNoErrors() {
        if(!parent::hasNoErrors() || empty($this->LabelData))
            return FALSE;

        foreach ($this->LabelData as $labelData):
            if(empty($labelData) || empty($labelData->Status))
                return FALSE;

            $statusArray = $labelData->Status;
            if(count($statusArray) !== 1 || !$this->firstStatusIsSuccess($statusArray))
                return FALSE;
        endforeach;

        return TRUE;
    }

    /**
     * @param Object[] $soapResponseLabelData
     * @param string   $languageLocale
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Data\LabelData[]
     */
    private function mapMultipleLabelData(array $soapResponseLabelData, $languageLocale) {
        $labelData = [];
        foreach ($soapResponseLabelData as $key => $value):
            $labelData[$key] = new Shipping\Data\LabelData($languageLocale, $value);
        endforeach;

        return $labelData;
    }
}