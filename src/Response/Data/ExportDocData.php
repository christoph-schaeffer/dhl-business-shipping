<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Data;

use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\AbstractStatus;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\StatusMapper;

/**
 * Class ExportDocData
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Data
 *
 * Contains the result of the document processing: in case of no errors, a base64 encoded PDF is contained; also, the
 * status of this particular document generation and the passed shipment number are returned.
 */
class ExportDocData {

    /**
     * @var AbstractStatus[]
     *
     * Status objects which have been returned. Those objects can be found in src/Status
     */
    public $Status;

    /**
     * @var string
     *
     * Export doc as base64 encoded pdf data
     */
    public $exportDocData;

    /**
     * @var string
     *
     * URL for downloading the Export doc as pdf
     */
    public $exportDocUrl;

    /**
     * @param string $languageLocale
     * @param object $exportDocDataResponse
     *
     * ExportDocData constructor.
     */
    public function __construct($languageLocale, $exportDocDataResponse = NULL) {
        if(empty($exportDocDataResponse))
            return;

        if(property_exists($exportDocDataResponse, 'Status'))
            $this->Status = StatusMapper::getStatusObjects($exportDocDataResponse->Status, $languageLocale);

        if(property_exists($exportDocDataResponse, 'exportDocURL'))
            $this->exportDocUrl = $exportDocDataResponse->exportDocURL;
        else if(property_exists($exportDocDataResponse, 'exportDocUrl'))
            $this->exportDocUrl = $exportDocDataResponse->exportDocUrl;

        if(property_exists($exportDocDataResponse, 'exportDocData'))
            $this->exportDocData = $exportDocDataResponse->exportDocData;
    }
}