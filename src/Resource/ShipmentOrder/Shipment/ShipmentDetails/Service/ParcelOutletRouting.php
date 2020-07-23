<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class ParcelOutletRouting
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Service configuration for ParcelOutletRouting. Details can be an email-address, if not set receiver email will be
 * used
 */
class ParcelOutletRouting extends AbstractService {

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