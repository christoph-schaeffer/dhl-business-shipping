<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking\PieceData;

/**
 * Class getStatusForPublicUser
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * @TODO description
 */
class getStatusForPublicUser extends AbstractTrackingRequest {

    /**
     * @var string
     *
     * Optional
     *
     * A date as a formatted string. This acts as a filter.
     * Format: YYYY-MM-DD. e.g. 2022-02-22
     */
    public $fromDate;
    /**
     * @var string
     *
     * Optional
     *
     * A date as a formatted string. This acts as a filter.
     * Format: YYYY-MM-DD. e.g. 2022-02-22
     */
    public $toDate;

    /**
     * getVersion constructor.
     *
     * @param PieceData[]
     */
    public function __construct($pieces) {
        parent::__construct();
        $this->contentObjects = $pieces;
    }

    public function getRequestString()
    {
        return 'get-status-for-public-user';
    }
}
