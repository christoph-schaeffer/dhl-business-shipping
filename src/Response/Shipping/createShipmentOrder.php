<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractShippingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Data\LabelData;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\State\CreationState;

/**
 * Class createShipmentOrder
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * This operation creates shipments for "DHL Paket" including the relevant shipping documents.
 * It will return the shipment number along with a shipping label which can be printed.
 */
class createShipmentOrder extends AbstractShippingResponse {

    /**
     * @var CreationState[]
     *
     * The operation's success status for every single ShipmentOrder will be returned by one CreationState element. It
     * is identifiable via SequenceNumber.
     */
    public $CreationStates;

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\createShipmentOrder
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\createShipmentOrder $request
     * @param object                      $rawResponse
     * @param string                      $rawRequest
     * @param string                      $languageLocale
     *
     * createShipmentOrder constructor.
     */
    public function __construct(Request\Shipping\createShipmentOrder $request, $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);

        if(!property_exists($rawResponse, 'CreationState'))
            return;

        if(is_array($rawResponse->CreationState)):
            $this->CreationStates = $this->mapMultipleCreationStates($rawResponse->CreationState, $languageLocale);
        elseif(!empty($rawResponse->CreationState)):
            $this->CreationStates[] = $this->mapCreationState($rawResponse->CreationState, $languageLocale);
        endif;
    }

    /**
     * @return bool
     *
     * Checks if the status array of the response and each creation state only contains one status,
     * which is the success status.
     */
    public function hasNoErrors() {
        if(!parent::hasNoErrors() || empty($this->CreationStates))
            return FALSE;

        foreach ($this->CreationStates as $creationState):
            if(empty($creationState) || empty($creationState->LabelData) || empty($creationState->LabelData->Status))
                return FALSE;

            $statusArray = $creationState->LabelData->Status;
            if(count($statusArray) !== 1 || !$this->firstStatusIsSuccess($statusArray))
                return FALSE;
        endforeach;

        return TRUE;
    }

    /**
     * @param Object $creationStateResponse
     * @param string $languageLocale
     *
     * @return CreationState;
     */
    private function mapCreationState($creationStateResponse, $languageLocale) {
        $creationState = new CreationState();
        if(property_exists($creationStateResponse, 'sequenceNumber'))
            $creationState->sequenceNumber = $creationStateResponse->sequenceNumber;

        if(property_exists($creationStateResponse, 'shipmentNumber'))
            $creationState->shipmentNumber = $creationStateResponse->shipmentNumber;

        if(property_exists($creationStateResponse, 'returnShipmentNumber'))
            $creationState->returnShipmentNumber = $creationStateResponse->returnShipmentNumber;

        if(property_exists($creationStateResponse, 'LabelData'))
            $creationState->LabelData = new LabelData($languageLocale, $creationStateResponse->LabelData);

        return $creationState;
    }

    /**
     * @param Object[] $soapResponseCreationStates
     * @param string   $languageLocale
     *
     * @return CreationState[]
     */
    private function mapMultipleCreationStates(array $soapResponseCreationStates, $languageLocale) {
        $creationState = [];
        foreach ($soapResponseCreationStates as $key => $value):
            $creationState[$key] = $this->mapCreationState($value, $languageLocale);
        endforeach;

        return $creationState;
    }

}