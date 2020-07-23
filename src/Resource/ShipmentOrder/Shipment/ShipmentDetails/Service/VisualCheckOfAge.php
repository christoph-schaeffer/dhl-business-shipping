<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class VisualCheckOfAge
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Service visual age check
 */
class VisualCheckOfAge extends AbstractService {

    /**
     * is 16 years or older.
     */
    const ABOVE_16 = 'A16';
    /**
     * is 18 years or older.
     */
    const ABOVE_18 = 'A18';

    /**
     * @var string
     *
     * Min length: 3
     * Max length: 3
     *
     * Service VisualCheckOfAge is used to specify the minimum age of the recipient There are the following types are
     * allowed: A16 - is 16 years or older. A18 - is 18 years or older.
     */
    public $type;

}