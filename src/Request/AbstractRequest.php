<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request;

use ChristophSchaeffer\Dhl\BusinessShipping\Client;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;

/**
 * Class AbstractRequest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 */
abstract class AbstractRequest {

    /**
     * The version of the webservice implementation for which the requesting client is developed.
     * This Will be auto-filled in the constructor.
     *
     * @var Version
     */
    public $Version;

    /**
     * Response constructor.
     */
    public function __construct() {
        $this->Version               = new Version();
        $this->Version->majorRelease = Client::MAJOR_RELEASE;
        $this->Version->minorRelease = Client::MINOR_RELEASE;
    }

}