<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;

/**
 * Class AbstractResponse
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 */
abstract class AbstractResponse {


    /**
     * @var Version
     *
     * The version of the webservice implementation for which the requesting client is developed.
     */
    public $Version;

    /**
     * @var string (XML)
     *
     * The raw request which has been sent to the DHL API endpoint. This can be used for debugging
     */
    public $rawRequest;

    /**
     * @var Object
     *
     * The raw response which has been sent from the DHL API endpoint. This can be used for debugging
     */
    public $rawResponse;

    /**
     * @var AbstractRequest
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param AbstractRequest $request
     * @param Object $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     *
     * AbstractResponse constructor.
     */
    public function __construct(AbstractRequest $request, $rawResponse, $rawRequest, $languageLocale) {
        $this->rawResponse = $rawResponse;
        $this->rawRequest  = $rawRequest;
        $this->request     = $request;
        $this->Version     = new Version();
    }

    /**
     * @return bool
     *
     * Checks if the request was successful. Will return true if it was.
     */
    public abstract function hasNoErrors();

}