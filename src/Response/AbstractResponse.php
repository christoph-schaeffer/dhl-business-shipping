<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\AbstractStatus;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\StatusMapper;

/**
 * Class Response
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 */
abstract class AbstractResponse {

    /**
     * @var AbstractStatus[]
     *
     * Status objects which have been returned. Those objects can be found in src/Status
     */
    public $Status;

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
     * @param Object          $soapResponse
     * @param string          $soapRequest
     * @param string          $languageLocale
     *
     * Response constructor.
     */
    public function __construct(AbstractRequest $request, $soapResponse, $soapRequest, $languageLocale) {
        $this->rawResponse = $soapResponse;
        $this->rawRequest  = $soapRequest;
        $this->request     = $request;

        $this->Version               = new Version();
        $this->Version->majorRelease = $soapResponse->Version->majorRelease;
        $this->Version->minorRelease = $soapResponse->Version->minorRelease;

        if(property_exists($soapResponse, 'Status'))
            $this->Status = StatusMapper::getStatusObjects($soapResponse->Status, $languageLocale);
    }

    /**
     * @return bool
     *
     * Checks if the status array only contains one status, which is the success status.
     */
    public function hasNoErrors() {
        return $this->Status === null || (count($this->Status) === 1 && $this->firstStatusIsSuccess($this->Status));
    }

    /**
     * @param AbstractStatus[] $statusArray
     *
     * @return bool
     */
    protected function firstStatusIsSuccess(array $statusArray) {
        if(empty($statusArray))
            return FALSE;

        $firstStatus = array_shift($statusArray);

        return is_a($firstStatus, Success::class);
    }

}