<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class Endorsement
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Service endorsement is used to specify handling if recipient not met
 */
class Endorsement extends AbstractService {

    /**
     * Return immediately.
     */
    const GERMANY_RETURN_IMMEDIATELY = 'SOZU';
    /**
     * 2nd attempt of Delivery.
     */
    const GERMANY_SECOND_ATTEMPT = 'ZWZU';
    /**
     * Sending back immediately to sender.
     */
    const INTERNATIONAL_RETURN_IMMEDIATELY = 'IMMEDIATE';
    /**
     * Sending back immediately to sender after expiration of time.
     */
    const INTERNATIONAL_AFTER_DEADLINE = 'AFTER_DEADLINE';
    /**
     * Abandonment of parcel at the hands of sender (free of charge)
     */
    const INTERNATIONAL_ABANDON = 'ABANDONMENT';

    /**
     * @var string
     *
     * Service endorsement is used to specify handling if recipient not met There are the following types are allowed:
     *
     * For Germany:
     * SOZU - Return immediately.
     * ZWZU - 2nd attempt of Delivery.
     *
     * for International:
     * IMMEDIATE - Sending back immediately to sender.
     * AFTER_DEADLINE - Sending back immediately to sender after expiration of time.
     * ABANDONMENT - Abandonment of parcel at the hands of sender (free of charge).
     */
    public $type;

}