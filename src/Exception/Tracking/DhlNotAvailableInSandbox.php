<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Exception\DhlException;

/**
 * Class DhlNotAvailableInSandbox
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking
 * @codeCoverageIgnore
 *
 * This exception is thrown if you try to call a function that has been disabled for sandbox mode by dhl. If this
 * exception wouldn't exist, you would just get authentication errors instead.
 */
class DhlNotAvailableInSandbox extends DhlException {

    /**
     * @param string $message
     * @param int $code
     * @param Object $previous
     */
    public function __construct($function, $message = "The function you have called is not available in sandbox mode", $code = 0, $previous = null) {
        if(empty($message)) {
            $message = "The $function function is not available in sandbox mode";
        }
        parent::__construct($message, $code, $previous);
    }
}
