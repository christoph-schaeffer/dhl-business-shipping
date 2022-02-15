<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;

/**
 * Class DhlRestHttpException
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking
 * @codeCoverageIgnore
 *
 * This exception is thrown on http failures with the rest client
 */
class DhlRestHttpException extends DhlRestException {

    public function __construct(AbstractTrackingRequest $request, $xmlRequest, $message = "", $code = 0, $previous = null) {
        if ($message === ""):
            $message = $code > 0 ? "DHL REST client http error. Code: $code" : "DHL REST client http error";
        endif;
        parent::__construct($request, $xmlRequest, $message, $code, $previous);
    }
}
