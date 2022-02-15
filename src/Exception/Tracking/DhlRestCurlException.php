<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;

/**
 * Class DhlRestCurlException
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking
 * @codeCoverageIgnore
 *
 * This exception is thrown on curl failures with the rest client
 */
class DhlRestCurlException extends DhlRestException {

    private $curlObject;

    /**
     * @param resource|false $curlHandle
     * @param AbstractTrackingRequest $request
     * @param string $xmlRequest
     * @param string $message
     * @param int $code
     * @param Object $previous
     */
    public function __construct($curlHandle, AbstractTrackingRequest $request, $xmlRequest, $message = "DHL REST client curl error", $code = 0, $previous = null) {
        parent::__construct($request, $xmlRequest, $message, $code, $previous);
        $this->curlObject = $curlHandle;
    }

    /**
     * @return resource|false
     */
    public function getCurlObject() {
        return $this->curlObject;
    }


}
