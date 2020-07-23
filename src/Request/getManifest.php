<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class getManifest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * With this operation end-of-day reports are available for a specific day or period. This will include all shipments
 * of that day.
 *
 */
class getManifest extends AbstractRequest {

    /**
     * @var string
     *
     * Format: YYYY-MM-DD
     *
     * Min length: 10
     * Max length: 10
     *
     * Date of the manifest
     */
    public $manifestDate;

    /**
     * @param string $manifestDate (Format: YYYY-MM-DD)
     *
     * getManifest constructor.
     */
    public function __construct($manifestDate) {
        parent::__construct();
        $this->manifestDate = $manifestDate;
    }

}