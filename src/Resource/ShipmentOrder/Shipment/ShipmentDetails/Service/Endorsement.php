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
     * Sending back immediately to sender after expiration of time.
     */
    const ABANDONMENT = 'ABANDONMENT';
    /**
     * Sending back immediately to sender.
     */
    const IMMEDIATE = 'IMMEDIATE';
    /**
     * Abandonment of parcel at the hands of sender (free of charge)
     */
    const AFTER_DEADLINE = 'AFTER_DEADLINE';

    /**
     * @deprecated
     */
    const GERMANY_RETURN_IMMEDIATELY = self::IMMEDIATE;
    /**
     * @deprecated
     */
    const INTERNATIONAL_RETURN_IMMEDIATELY = self::IMMEDIATE;
    /**
     * @deprecated
     */
    const INTERNATIONAL_AFTER_DEADLINE = self::AFTER_DEADLINE;
    /**
     * @deprecated
     */
    const INTERNATIONAL_ABANDON = SELF::ABANDONMENT;



    /**
     * @var string
     *
     * Service endorsement is used to specify handling if recipient not met There are the following types are allowed:
     *
     * IMMEDIATE - Sending back immediately to sender.
     * AFTER_DEADLINE - Sending back immediately to sender after expiration of time.
     * ABANDONMENT - Abandonment of parcel at the hands of sender (free of charge).
     */
    public $type;

}