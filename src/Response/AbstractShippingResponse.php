<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractShippingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\ShippingStatusMapper;

/**
 * Class AbstractShippingResponse
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 */
abstract class AbstractShippingResponse extends AbstractResponse {

    /**
     * @var AbstractStatus[]
     *
     * Status objects which have been returned. Those objects can be found in src/Status
     */
    public $Status;

    /**
     * @param AbstractShippingRequest $request
     * @param Object $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     *
     * AbstractShippingResponse constructor.
     */
    public function __construct(AbstractShippingRequest $request, $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);

        if (property_exists($rawResponse, 'Status'))
            $this->Status = ShippingStatusMapper::getStatusObjects($rawResponse->Status, $languageLocale);
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
        if (empty($statusArray))
            return FALSE;

        $firstStatus = array_shift($statusArray);

        return is_a($firstStatus, Success::class);
    }

}