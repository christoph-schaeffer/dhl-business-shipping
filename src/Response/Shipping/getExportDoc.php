<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractShippingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping;

/**
 * Class getExportDoc
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * This operation hands back export documents for previously created shipments.
 */
class getExportDoc extends AbstractShippingResponse {

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Data\ExportDocData[]
     *
     * Contains the result of the document processing: in case of no errors, a base64 encoded PDF is contained; also,
     * the status of this particular document generation and the passed shipment number are returned.
     */
    public $ExportDocData;

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getExportDoc
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getExportDoc $request
     * @param object               $rawResponse
     * @param string               $rawRequest
     * @param string               $languageLocale
     *
     * getExportDoc constructor.
     */
    public function __construct(Request\Shipping\getExportDoc $request, $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);

        if(!property_exists($rawResponse, 'ExportDocData'))
            return;

        if(is_array($rawResponse->ExportDocData)):
            $this->ExportDocData = $this->mapMultipleExportDocData($rawResponse->ExportDocData, $languageLocale);
        elseif(!empty($rawResponse->ExportDocData)):
            $this->ExportDocData[] = new Shipping\Data\ExportDocData($languageLocale, $rawResponse->ExportDocData);
        endif;
    }

    /**
     * @return bool
     *
     * Checks if the status array of the response and each export doc data object only contains one status,
     * which is the success status.
     */
    public function hasNoErrors() {
        if(!parent::hasNoErrors() || empty($this->ExportDocData))
            return FALSE;

        foreach ($this->ExportDocData as $exportDocData):
            if(empty($exportDocData) || empty($exportDocData->Status))
                return FALSE;

            $statusArray = $exportDocData->Status;
            if(count($statusArray) !== 1 || !$this->firstStatusIsSuccess($statusArray))
                return FALSE;
        endforeach;

        return TRUE;
    }

    /**
     * @param Object[] $soapResponseExportDocData
     * @param string   $languageLocale
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Data\ExportDocData[]
     */
    public function mapMultipleExportDocData($soapResponseExportDocData, $languageLocale) {
        $exportDocData = [];
        foreach ($soapResponseExportDocData as $key => $value):
            $exportDocData[$key] = new Shipping\Data\ExportDocData($languageLocale, $value);
        endforeach;

        return $exportDocData;
    }
}