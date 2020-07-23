<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class ShipmentHandling
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Shipment handling for product:
 * V06TG: Kurier Taggleich
 * V06WZ: Kurier Wunschzeit
 */
class ShipmentHandling extends AbstractService {

    /**
     * Remove content, return box.
     */
    const REMOVE_CONTENT_RETURN_BOX = 'a';
    /**
     * Remove content, pick up and dispose cardboard packaging.
     */
    const REMOVE_CONTENT_DISPOSE_CARDBOARD_PACKAGING = 'b';
    /**
     * Handover parcel/box to customer, no disposal of cardboard/box.
     */
    const HANDOVER_PACKAGE_TO_CUSTOMER_NO_DISPOSAL = 'c';
    /**
     * Remove bag from/of cooling unit and handover to customer.
     */
    const REMOVE_BAG_OF_COOLING_UNIT_HANDOVER_TO_CUSTOMER = 'd';
    /**
     * Remove content, apply return label und seal box, return box.
     */
    const REMOVE_CONTENT_APPLY_RETURN_LABEL_RETURN_BOX = 'e';

    /**
     * @var string
     *
     * Min length: 1
     * Max length: 1
     *
     * Type of shipment handling. There are the following types are allowed:
     * a: Remove content, return box.
     * b: Remove content, pick up and dispose cardboard packaging.
     * c: Handover parcel/box to customer, no disposal of cardboard/box.
     * d: Remove bag from/of cooling unit and handover to customer.
     * e: Remove content, apply return label und seal box, return box.
     */
    public $type;

}