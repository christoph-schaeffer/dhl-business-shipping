<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;

/**
 * Class DhlRestException
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking
 *
 * This exception is thrown on failures with the rest client
 */
class DhlRestException extends \Exception {

    /** @var string */
    private $xmlRequest;
    /** @var AbstractTrackingRequest */
    private $request;

    /**
     * @param AbstractTrackingRequest $request
     * @param string $xmlRequest
     * @param string $message
     * @param int $code
     * @param Object $previous
     */
    public function __construct(AbstractTrackingRequest $request, $xmlRequest, $message = "DHL REST client error", $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->xmlRequest = $xmlRequest;
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getXmlRequest()
    {
        return $this->xmlRequest;
    }

    /**
     * @return AbstractTrackingRequest
     */
    public function getRequest()
    {
        return $this->request;
    }


}
