<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Data;

use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\AbstractStatus;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\StatusMapper;

/**
 * Class LabelData
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Data
 *
 * For successful operations, a shipment label is created and returned. Depending on the invoked product.
 * Depending on the requested responseType only labelData or labelUrl properties will be filled.
 */
class LabelData {

    /**
     * @var AbstractStatus[]
     *
     * Status objects which have been returned. Those objects can be found in src/Status
     */
    public $Status;

    /**
     * @var string
     *
     * Label as base64 encoded pdf data, depending on setting in customer profile all labels or just the cod related
     * documents.
     */
    public $codLabelData;

    /**
     * @var string
     *
     * If label output format was requested as 'URL' via LabelResponseType, this element will be returned. It contains
     * the URL to access the PDF label. This is default output format if not specified other by client in
     * labelResponseType. Depending on setting in customer profile all labels or just the cod related documents.
     */
    public $codLabelUrl;

    /**
     * @var string
     *
     * Label as base64 encoded pdf data, depending on setting in customer profile all labels or just the shipmentlabel.
     */
    public $labelData;

    /**
     * @var string
     *
     * If label output format was requested as 'URL' via LabelResponseType, this element will be returned. It contains
     * the URL to access the PDF label. This is default output format if not specified other by client in
     * labelResponseType. Depending on setting in customer profile all labels or just the shipmentlabel.
     */
    public $labelUrl;

    /**
     * @var string
     *
     * Label as base64 encoded pdf data, depending on setting in customer profile all labels or just the export
     * documents.
     */
    public $exportLabelData;

    /**
     * @var string
     *
     * If label output format was requested as 'URL' via LabelResponseType, this element will be returned. It contains
     * the URL to access the PDF label. This is default output format if not specified other by client in
     * labelResponseType. Depending on setting in customer profile all labels or just the export documents.
     */
    public $exportLabelUrl;

    /**
     * @var string
     *
     * Label as base64 encoded pdf data, depending on setting in customer profile all labels or just the
     * returnshipmentlabel.
     */
    public $returnLabelData;

    /**
     * @var string
     *
     * If label output format was requested as 'URL' via LabelResponseType, this element will be returned. It contains
     * the URL to access the PDF label. This is default output format if not specified other by client in
     * labelResponseType. Depending on setting in customer profile all labels or just the returnshipmentlabel.
     */
    public $returnLabelUrl;

    /**
     * @param string $languageLocale
     * @param object $labelDataResponse
     *
     * LabelData constructor.
     */
    public function __construct($languageLocale, $labelDataResponse = NULL) {
        if(empty($labelDataResponse))
            return;

        foreach ($labelDataResponse as $property => $value):
            if($property === 'Status'):
                $this->Status = StatusMapper::getStatusObjects($value, $languageLocale);
            elseif(property_exists($this, $property)):
                $this->{$property} = $value;
            endif;
        endforeach;
    }
}