<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\State\DeletionState;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\StatusMapper;

/**
 * Class deleteShipmentOrder
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * This operation cancels earlier created shipments. However, this will only work for shipments for that you
 * haven't called the doManifest function. Also keep in mind that if not set otherwise in the
 * "Geschäftskundenportal" there will be an automatic doManifest call on all open shipments at 6 pm every day.
 */
class deleteShipmentOrder extends AbstractResponse {

    /**
     * @var DeletionState[]
     *
     * For every ShipmentNumber requested, one DeletionState node is returned that contains the status of the
     * respective deletion operation.
     */
    public $DeletionStates;

    /**
     * @var Request\deleteShipmentOrder
     *
     * The request object of this response.
     */
    public $request;

    /**
     * @param Request\deleteShipmentOrder $request
     * @param object                      $soapResponse
     * @param string                      $soapRequest
     * @param string                      $languageLocale
     *
     * deleteShipmentOrder constructor.
     */
    public function __construct(Request\deleteShipmentOrder $request, $soapResponse, $soapRequest, $languageLocale) {
        parent::__construct($request, $soapResponse, $soapRequest, $languageLocale);

        if(!property_exists($soapResponse, 'DeletionState'))
            return;

        if(is_array($soapResponse->DeletionState)):
            $this->DeletionStates = $this->mapMultipleDeletionStates($soapResponse->DeletionState, $languageLocale);
        elseif(!empty($soapResponse->DeletionState)):
            $this->DeletionStates[] = $this->mapDeletionState($soapResponse->DeletionState, $languageLocale);
        endif;
    }

    /**
     * @return bool
     *
     * Checks if the status array of the response and each deletion state only contains one status,
     * which is the success status.
     */
    public function hasNoErrors() {
        if(!parent::hasNoErrors() || empty($this->DeletionStates))
            return FALSE;

        foreach ($this->DeletionStates as $deletionState):
            if(empty($deletionState) || empty($deletionState->Status))
                return FALSE;

            $statusArray = $deletionState->Status;
            if(count($statusArray) !== 1 || !$this->firstStatusIsSuccess($statusArray))
                return FALSE;
        endforeach;

        return TRUE;
    }

    /**
     * @param Object $deletionStateResponse
     * @param string $languageLocale
     *
     * @return DeletionState;
     */
    private function mapDeletionState($deletionStateResponse, $languageLocale) {
        $deletionState = new DeletionState();
        if(property_exists($deletionStateResponse, 'Status'))
            $deletionState->Status = StatusMapper::getStatusObjects($deletionStateResponse->Status, $languageLocale);

        if(property_exists($deletionStateResponse, 'shipmentNumber'))
            $deletionState->shipmentNumber = $deletionStateResponse->shipmentNumber;

        return $deletionState;
    }

    /**
     * @param Object[] $soapResponseDeletionStates
     * @param string   $languageLocale
     *
     * @return DeletionState[]
     */
    private function mapMultipleDeletionStates(array $soapResponseDeletionStates, $languageLocale) {
        $deletionStates = [];
        foreach ($soapResponseDeletionStates as $key => $value):
            $deletionStates[$key] = $this->mapDeletionState($value, $languageLocale);
        endforeach;

        return $deletionStates;
    }
}