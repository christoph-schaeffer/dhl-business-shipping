<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\State\ManifestState;

/**
 * Class getManifest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * With this operation end-of-day reports are available for a specific day or period.
 */
class getManifest extends AbstractResponse {

    /**
     * @var string
     *
     * The Base64 encoded pdf data for receiving the manifest.
     */
    public $manifestData;

    /**
     * @var Request\getManifest
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param Request\getManifest $request
     * @param object              $soapResponse
     * @param string              $soapRequest
     * @param string              $languageLocale
     *
     * getManifest constructor.
     */
    public function __construct(Request\getManifest $request, $soapResponse, $soapRequest, $languageLocale) {
        parent::__construct($request, $soapResponse, $soapRequest, $languageLocale);

        if(property_exists($soapResponse, 'manifestData'))
            $this->manifestData = $soapResponse->manifestData;
    }
}