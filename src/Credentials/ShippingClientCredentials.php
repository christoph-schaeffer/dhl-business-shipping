<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Credentials;

/**
 * Class ShippingClientCredentials
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Credentials
 */
class ShippingClientCredentials {

    /** @var string */
    public $appID;
    /** @var string */
    public $apiToken;
    /** @var string */
    public $login;
    /** @var string */
    public $password;

    public function __construct($appID, $apiToken, $login = '2222222222_01', $password = 'pass') // the default parameters can be used for sandbox mode
    {
        $this->appID    = $appID;
        $this->apiToken = $apiToken;
        $this->login    = $login;
        $this->password = $password;
    }

}
