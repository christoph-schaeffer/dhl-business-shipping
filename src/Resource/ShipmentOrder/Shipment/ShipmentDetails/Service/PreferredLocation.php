<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class PreferredLocation
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Service preferred location
 */
class PreferredLocation extends AbstractService {

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 100
     *
     * Details of the Service (free text).
     */
    public $details;

}