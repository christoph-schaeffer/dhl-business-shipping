<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractRequest;

/**
 * Class SoapClient
 * @package ChristophSchaeffer\Dhl\BusinessShipping
 *
 * Extends the php extensions soap class with the dhl apis specific urls, wsdl and authentication
 */
class Soap extends \SoapClient {

    const HEADER_NAMESPACE = 'http://dhl.de/webservice/cisbase';
    const PRODUCTION_URL   = 'https://cig.dhl.de/services/production/soap';
    const SANDBOX_URL      = 'https://cig.dhl.de/services/sandbox/soap';
    const WSDL_PATH        = __DIR__ . '/../wsdl/geschaeftskundenversand-api-3.1.8.wsdl';

    /**
     * @param string $appID
     * @param string $apiToken
     * @param string $login
     * @param string $password
     * @param bool   $isSandbox
     *
     * @throws \SoapFault
     *
     * Soap constructor.
     */
    public function __construct($appID, $apiToken, $login, $password, $isSandbox = FALSE) {
        parent::__construct(
            self::WSDL_PATH,
            [
                'login'    => $appID,
                'password' => $apiToken,
                'location' => $isSandbox ? self::SANDBOX_URL : self::PRODUCTION_URL
            ]
        );

        $this->__setSoapHeaders($this->constructSoapHeader($login, $password));
    }

    /**
     * @param string          $function
     * @param AbstractRequest $request
     *
     * @return Object //soapResponse
     *
     * @codeCoverageIgnore
     */
    public function callSoapFunction($function, AbstractRequest $request) {
        return $this->$function($request);
    }

    /**
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function getLastSoapXMLRequest() {
        return $this->__getLastRequest();
    }

    /**
     * @param string $login
     * @param string $password
     *
     * @return \SoapHeader
     */
    private function constructSoapHeader($login, $password) {
        return new \SoapHeader(
            self::HEADER_NAMESPACE,
            'Authentification', [
                'user'      => $login,
                'signature' => $password
            ]);
    }

}

