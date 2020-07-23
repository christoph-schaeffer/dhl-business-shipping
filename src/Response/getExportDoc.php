<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class getExportDoc
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * This operation hands back export documents for previously created shipments.
 */
class getExportDoc extends AbstractResponse {

    /**
     * @var Data\ExportDocData[]
     *
     * Contains the result of the document processing: in case of no errors, a base64 encoded PDF is contained; also,
     * the status of this particular document generation and the passed shipment number are returned.
     */
    public $ExportDocData;

    /**
     * @var Request\getExportDoc
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param Request\getExportDoc $request
     * @param object               $soapResponse
     * @param string               $soapRequest
     * @param string               $languageLocale
     *
     * getExportDoc constructor.
     */
    public function __construct(Request\getExportDoc $request, $soapResponse, $soapRequest, $languageLocale) {
        parent::__construct($request, $soapResponse, $soapRequest, $languageLocale);

        if(!property_exists($soapResponse, 'ExportDocData'))
            return;

        if(is_array($soapResponse->ExportDocData)):
            $this->ExportDocData = $this->mapMultipleExportDocData($soapResponse->ExportDocData, $languageLocale);
        elseif(!empty($soapResponse->ExportDocData)):
            $this->ExportDocData[] = new Data\ExportDocData($languageLocale, $soapResponse->ExportDocData);
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
     * @return Data\ExportDocData[]
     */
    public function mapMultipleExportDocData($soapResponseExportDocData, $languageLocale) {
        $exportDocData = [];
        foreach ($soapResponseExportDocData as $key => $value):
            $exportDocData[$key] = new Data\ExportDocData($languageLocale, $value);
        endforeach;

        return $exportDocData;
    }
}