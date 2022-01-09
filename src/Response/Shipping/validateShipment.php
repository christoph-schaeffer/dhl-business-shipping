<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractShippingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\State\ValidationState;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\ShippingStatusMapper;

/**
 * Class validateShipment
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * With this operation the data for a shipment can be validated before a shipment label and tracking number will be
 * created.
 */
class validateShipment extends AbstractShippingResponse {

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\State\ValidationState[]
     *
     * The operation's success status for every single ShipmentOrder will be returned by one CreationState element. It
     * is identifiable via SequenceNumber.
     */
    public $ValidationStates;

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\validateShipment
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\validateShipment $request
     * @param object                   $rawResponse
     * @param string                   $rawRequest
     * @param string                   $languageLocale
     *
     * validateShipment constructor.
     */
    public function __construct(Request\Shipping\validateShipment $request, $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);

        if(!property_exists($rawResponse, 'ValidationState'))
            return;

        if(is_array($rawResponse->ValidationState)):
            $this->ValidationStates = $this->mapMultipleValidationStates($rawResponse->ValidationState, $languageLocale);
        elseif(!empty($rawResponse->ValidationState)):
            $this->ValidationStates[] = $this->mapValidationState($rawResponse->ValidationState, $languageLocale);
        endif;
    }

    /**
     * @return bool
     *
     * Checks if the status array of the response and each validation state only contains one status,
     * which is the success status.
     */
    public function hasNoErrors() {
        if(!parent::hasNoErrors() || empty($this->ValidationStates))
            return FALSE;

        foreach ($this->ValidationStates as $validationState):
            if(empty($validationState) || empty($validationState->Status))
                return FALSE;

            $statusArray = $validationState->Status;
            if(count($statusArray) !== 1 || !$this->firstStatusIsSuccess($statusArray))
                return FALSE;
        endforeach;

        return TRUE;
    }

    /**
     * @param Object[] $soapResponseValidationStates
     * @param string   $languageLocale
     *
     * @return ValidationState[]
     */
    private function mapMultipleValidationStates($soapResponseValidationStates, $languageLocale) {
        $validationStates = [];
        foreach ($soapResponseValidationStates as $key => $value):
            $validationStates[$key] = $this->mapValidationState($value, $languageLocale);
        endforeach;

        return $validationStates;
    }

    /**
     * @param Object $validationStateResponse
     * @param string $languageLocale
     *
     * @return \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\State\ValidationState;
     */
    private function mapValidationState($validationStateResponse, $languageLocale) {
        $validationState = new ValidationState();
        if(property_exists($validationStateResponse, 'sequenceNumber'))
            $validationState->sequenceNumber = $validationStateResponse->sequenceNumber;

        if(property_exists($validationStateResponse, 'Status'))
            $validationState->Status = ShippingStatusMapper::getStatusObjects($validationStateResponse->Status, $languageLocale);

        return $validationState;
    }
}