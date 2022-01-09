<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractShippingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\State\ManifestState;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\ShippingStatusMapper;

/**
 * Class doManifest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * With this operation a end-of-day closing for up to 30 previously created shipments can be carried out. Please
 * keep in mind, that once you have called this function for a shipment order it can't be canceled anymore.
 */
class doManifest extends AbstractShippingResponse {

    /**
     * @var ManifestState[]
     *
     * The status of the operation for the corresponding shipment(s).
     */
    public $ManifestStates;

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\doManifest
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\doManifest $request
     * @param object             $rawResponse
     * @param string             $rawRequest
     * @param string             $languageLocale
     *
     * doMannifest constructor.
     */
    public function __construct(Request\Shipping\doManifest $request, $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);

        if(!property_exists($rawResponse, 'ManifestState'))
            return;

        if(is_array($rawResponse->ManifestState)):
            $this->ManifestStates = $this->mapMultipleManifestStates($rawResponse->ManifestState, $languageLocale);
        elseif(!empty($rawResponse->ManifestState)):
            $this->ManifestStates[] = $this->mapManifestState($rawResponse->ManifestState, $languageLocale);
        endif;
    }

    /**
     * @return bool
     *
     * Checks if the status array of the response and each manifest state only contains one status,
     * which is the success status.
     */
    public function hasNoErrors() {
        if(!parent::hasNoErrors() || empty($this->ManifestStates))
            return FALSE;

        foreach ($this->ManifestStates as $manifestState):
            if(empty($manifestState) || empty($manifestState->Status))
                return FALSE;

            $statusArray = $manifestState->Status;
            if(count($statusArray) !== 1 || !$this->firstStatusIsSuccess($statusArray))
                return FALSE;
        endforeach;

        return TRUE;
    }

    /**
     * @param Object $manifestStateResponse
     * @param string $languageLocale
     *
     * @return ManifestState;
     */
    private function mapManifestState($manifestStateResponse, $languageLocale) {
        $manifestState = new ManifestState();
        if(property_exists($manifestStateResponse, 'shipmentNumber'))
            $manifestState->shipmentNumber = $manifestStateResponse->shipmentNumber;

        if(property_exists($manifestStateResponse, 'Status'))
            $manifestState->Status = ShippingStatusMapper::getStatusObjects($manifestStateResponse->Status, $languageLocale);

        return $manifestState;
    }

    /**
     * @param Object[] $soapResponseManifestStates
     * @param string   $languageLocale
     *
     * @return ManifestState[]
     */
    private function mapMultipleManifestStates(array $soapResponseManifestStates, $languageLocale) {
        $manifestStates = [];
        foreach ($soapResponseManifestStates as $key => $value):
            $manifestStates[$key] = $this->mapManifestState($value, $languageLocale);
        endforeach;

        return $manifestStates;
    }
}