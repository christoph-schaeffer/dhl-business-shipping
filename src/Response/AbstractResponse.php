<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractShippingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\TrackingClient;

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
     * @param Object           $rawResponse
     * @param string          $rawRequest
     * @param string          $languageLocale
     *
     * AbstractResponse constructor.
     */
    public function __construct(AbstractRequest $request, $rawResponse, $rawRequest, $languageLocale) {
        $this->rawResponse = $rawResponse;
        $this->rawRequest  = $rawRequest;
        $this->request     = $request;

        $this->Version = new Version();
        if(is_a($request, AbstractShippingRequest::class)) {
            $this->Version->majorRelease = $rawResponse->Version->majorRelease;
            $this->Version->minorRelease = $rawResponse->Version->minorRelease;
        } else {
            $this->Version->majorRelease = TrackingClient::MAJOR_RELEASE;
            $this->Version->minorRelease = TrackingClient::MINOR_RELEASE;
        }
    }

    /**
     * @return bool
     *
     * Checks if the request was successful. Should return true if it was.
     */
    public abstract function hasNoErrors();


}