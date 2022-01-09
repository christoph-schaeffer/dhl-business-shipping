<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractShippingResponse;

/**
 * Class getManifest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * With this operation end-of-day reports are available for a specific day or period.
 */
class getManifest extends AbstractShippingResponse {

    /**
     * @var string
     *
     * The Base64 encoded pdf data for receiving the manifest.
     */
    public $manifestData;

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getManifest
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getManifest $request
     * @param object              $rawResponse
     * @param string              $rawRequest
     * @param string              $languageLocale
     *
     * getManifest constructor.
     */
    public function __construct(Request\Shipping\getManifest $request, $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);

        if(property_exists($rawResponse, 'manifestData'))
            $this->manifestData = $rawResponse->manifestData;
    }
}