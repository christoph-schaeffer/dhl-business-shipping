<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class AdditionalInsurance
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Insure shipment with higher than standard amount.
 */
class AdditionalInsurance extends AbstractService {

    /**
     * @var float
     *
     * Please enter the Amount that should be insured. There are specific amounts that can be insured, however this
     * may change over time. Currently (April 2020) up to 500 EUR is included without the service. With the service it
     * can be ≤2500 EUR or ≤25000 EUR
     */
    public $insuranceAmount;

}