<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractShippingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\ShippingClient;

/**
 * Class getVersion
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * With this operation the latest version available on the web can be queried.
 */
class getVersion extends AbstractShippingRequest {

    /**
     * @var string
     *
     * Min length: 1
     * Max length: 2
     *
     * The number of the major release. E.g. the '3' in version "3.0".
     * This Will be auto-filled in the constructor.
     */
    public $majorRelease;

    /**
     * @var string
     *
     * Min length: 1
     * Max length: 2
     *
     * The number of the minor release. E.g. the '0' in version "3.0".
     * This Will be auto-filled in the constructor.
     */
    public $minorRelease;

    /**
     * getVersion constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->majorRelease = ShippingClient::MAJOR_RELEASE;
        $this->minorRelease = ShippingClient::MINOR_RELEASE;
    }
}
