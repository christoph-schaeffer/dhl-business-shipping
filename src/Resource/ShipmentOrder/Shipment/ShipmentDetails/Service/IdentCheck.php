<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class IdentCheck
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Service configuration for IdentCheck.
 */
class IdentCheck extends AbstractService {

    /**
     * @var IdentCheck\Ident
     *
     * Identity data which needs to be checked
     */
    public $Ident;

    /**
     * IdentCheck constructor.
     */
    public function __construct() {
        $this->Ident = new IdentCheck\Ident();
    }

}