<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class getLabel
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * This operation hands back the shipping label for previously created shipments.
 */
class getLabel extends AbstractResponse {

    /**
     * @var Data\LabelData[]
     *
     * For every ShipmentNumber requested, one LabelData node is returned that contains the status of the label
     * retrieval operation and the URL for the label (if available).
     */
    public $LabelData;

    /**
     * @var Request\getLabel
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param Request\getLabel $request
     * @param object           $soapResponse
     * @param string           $soapRequest
     * @param string           $languageLocale
     *
     * getLabel constructor.
     */
    public function __construct(Request\getLabel $request, $soapResponse, $soapRequest, $languageLocale) {
        parent::__construct($request, $soapResponse, $soapRequest, $languageLocale);

        if(!property_exists($soapResponse, 'LabelData'))
            return;

        if(is_array($soapResponse->LabelData)):
            $this->LabelData = $this->mapMultipleLabelData($soapResponse->LabelData, $languageLocale);
        elseif(!empty($soapResponse->LabelData)):
            $this->LabelData[] = new Data\LabelData($languageLocale, $soapResponse->LabelData);
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
     * @return Data\LabelData[]
     */
    private function mapMultipleLabelData(array $soapResponseLabelData, $languageLocale) {
        $labelData = [];
        foreach ($soapResponseLabelData as $key => $value):
            $labelData[$key] = new Data\LabelData($languageLocale, $value);
        endforeach;

        return $labelData;
    }
}