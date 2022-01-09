<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractShippingResponse;

/**
 * Class getVersion
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * With this operation the latest version available on the web can be queried.
 */
class getVersion extends AbstractShippingResponse {

    /**
     * @var \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getVersion
     *
     * The request object of this response.
     */
    public $request;
}