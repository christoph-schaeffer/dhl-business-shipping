<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class PreferredNeighbour
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Service preferred neighbour
 */
class PreferredNeighbour extends AbstractService {

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 100
     *
     * Details of the Service (free text)
     */
    public $details;

}