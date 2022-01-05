<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Credentials;

/**
 * Class TrackingClientCredentials
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Credentials
 */
class TrackingClientCredentials {

    /** @var string */
    public $appID;
    /** @var string */
    public $apiToken;
    /** @var string */
    public $ztToken;
    /** @var string */
    public $password;

    public function __construct($appID, $apiToken, $ztToken = 'zt12345', $password = 'geheim') // the default parameters can be used for sandbox mode
    {
        $this->appID = $appID;
        $this->apiToken = $apiToken;
        $this->ztToken = $ztToken;
        $this->password = $password;
    }

}
