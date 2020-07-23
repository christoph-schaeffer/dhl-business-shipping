<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class IndividualSenderRequirement
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Individual sender requirements for product:
 * V06TG: Kurier Taggleich
 * V06WZ: Kurier Wunschzeit
 */
class IndividualSenderRequirement extends AbstractService {

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 250
     *
     * Individual details for handling (free text)
     */
    public $details;

}