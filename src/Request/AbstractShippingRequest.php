<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\ShippingClient;

/**
 * Class AbstractShippingRequest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 */
abstract class AbstractShippingRequest extends AbstractRequest {

    /**
     * The version of the webservice implementation for which the requesting client is developed.
     * This Will be auto-filled in the constructor.
     *
     * @var Version
     */
    public $Version;

    /**
     * AbstractShippingRequest constructor.
     */
    public function __construct() {
        $this->Version               = new Version();
        $this->Version->majorRelease = ShippingClient::MAJOR_RELEASE;
        $this->Version->minorRelease = ShippingClient::MINOR_RELEASE;
    }

}
