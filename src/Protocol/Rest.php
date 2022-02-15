<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Protocol;


use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlRestCurlException;
use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlRestHttpException;
use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlXmlParseException;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;

/**
 * Class Rest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Protocol
 *
 * This class is the transport layer for this library when using rest apis. So far it is only the tracking api
 * You should not use the class directly and instead use the TrackingClient or MultiClient classes.
 */
class Rest {

    const PRODUCTION_URL = 'https://cig.dhl.de/services/production/rest/sendungsverfolgung';
    const SANDBOX_URL    = 'https://cig.dhl.de/services/sandbox/rest/sendungsverfolgung';

    /** @var string */
    private $appID;
    /** @var string */
    private $apiToken;
    /** @var bool */
    private $isSandbox;

    /**
     * @param string $appID
     * @param string $apiToken
     * @param bool $isSandbox
     *
     * Rest constructor.
     */
    public function __construct($appID, $apiToken, $isSandbox) {
        $this->appID                = $appID;
        $this->apiToken             = $apiToken;
        $this->isSandbox            = $isSandbox;
    }

    /**
     * @param string $xml
     * @param AbstractTrackingRequest|null $request
     * @param string|null $contentType
     * @throws DhlRestCurlException
     * @throws DhlRestHttpException
     * @throws DhlXmlParseException
     * @codeCoverageIgnore
     */
    public function callRestFunction($xml, $request = null, $contentType = 'text/xml') {
        $curl = curl_init($this->isSandbox ? self::SANDBOX_URL : self::PRODUCTION_URL);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: $contentType"]);
        curl_setopt($curl, CURLOPT_USERPWD, $this->appID . ":" . $this->apiToken);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $responseXml = curl_exec($curl);

        if (curl_errno($curl)):
            throw new DhlRestCurlException(curl_error($curl), $request, $xml);
        endif;

        $this->handleHttpCodes(curl_getinfo($curl, CURLINFO_HTTP_CODE), $request, $xml);
        curl_close($curl);

        return $responseXml;
    }

    /**
     * @param int $httpCode
     * @param AbstractTrackingRequest $request
     * @param string $xml
     *
     * @throws DhlRestHttpException
     * @codeCoverageIgnore
     */
    private function handleHttpCodes($httpCode, $request, $xml) {
        switch ($httpCode) {
            case 200:
                return;
            case 401:
                throw new DhlRestHttpException($request, $xml, "$httpCode Unauthorized - Please check your tracking client credentials", $httpCode);
            case 403:
                throw new DhlRestHttpException($request, $xml, "$httpCode Forbidden - Please check if you are allowed to do this action", $httpCode);
            case 500:
                throw new DhlRestHttpException($request, $xml, "$httpCode The API Endpoint had an internal server error. Please check your input data", $httpCode);
            default:
                throw new DhlRestHttpException($request, $xml, "Unexcepted HTTP Code - $httpCode", $httpCode);
        }
    }

}
