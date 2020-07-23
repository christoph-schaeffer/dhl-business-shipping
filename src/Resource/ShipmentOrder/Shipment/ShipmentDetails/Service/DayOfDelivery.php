<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class DayOfDelivery
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Day of Delivery for product: V06TG: Kurier Taggleich; V06WZ: Kurier Wunschzeit
 */
class DayOfDelivery extends AbstractService {

    /**
     * @var string
     *
     * Format: YYYY-MM-DD
     *
     * Min length: 10
     * Max length: 10
     *
     * Date of delivery
     */
    public $details;

}