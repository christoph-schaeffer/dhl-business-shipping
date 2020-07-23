<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class getVersion
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 *
 * With this operation the latest version available on the web can be queried.
 */
class getVersion extends AbstractResponse {

    /**
     * @var Request\getVersion
     *
     * The request object of this response.
     */
    public $request;
}