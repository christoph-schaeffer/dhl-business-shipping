<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource;

/**
 * Class AbstractService
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment
 *
 * Additional services e.g. preferred location, day of delivery, delivery timeframe.
 * Successful booking of a particular service depends on account permissions and product's service combinatorics.
 * I.e. not every service is allowed for every product, or can be combined with all other allowed services.
 * The service bundles that contain all services are the following.
 */
abstract class AbstractService {

    /**
     * @var bool
     *
     * Indicates, if the service is on/off
     */
    public $active;

}