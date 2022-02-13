<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Protocol;


use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlRestCurlException;
use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlRestHttpException;
use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlXmlParseException;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class Rest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Protocol
 *
 * This is the main class of this plugin, which is used to call function of the api.
 */
class Rest {

    const PRODUCTION_URL = 'https://cig.dhl.de/services/production/rest/sendungsverfolgung';
    const SANDBOX_URL    = 'https://cig.dhl.de/services/sandbox/rest/sendungsverfolgung';

    /** @var string */
    private $appID;
    /** @var string */
    private $apiToken;
    /** @var string */
    private $zTToken;
    /** @var string */
    private $password;
    /** @var bool */
    private $isSandbox;
    /** @var string */
    private $languageLocaleAlpha2;
    /** @var string */
    private $lastXML;

    /**
     * @param AbstractTrackingRequest $request
     * @param object[] $contentObjects
     */
    public function callFunction($request, $xmlVersion = "1.0", $encoding = 'ISO-8859-1') {
        $request = $this->fillRequestData($request);

        $xml        = '<?xml version="' . $xmlVersion . '" encoding="' . $encoding . '" ?>';
        $xmlContent = '';
        if (isset($request->contentObjects)):
            foreach ($request->contentObjects as $contentObject):
                $xmlContent .= XmlParser::parseToXml($contentObject);
            endforeach;
        endif;

        $xml .= XmlParser::parseToXml($request, $xmlContent);

        return $this->sendCurl($xml, $request);
    }

    /**
     * @param string $appID
     * @param string $apiToken
     * @param string $zTToken
     * @param string $password
     * @param bool $isSandbox
     *
     * Rest constructor.
     */
    public function __construct($appID, $apiToken, $zTToken, $password, $isSandbox, $languageLocaleAlpha2) {
        $this->appID                = $appID;
        $this->apiToken             = $apiToken;
        $this->zTToken              = $zTToken;
        $this->password             = $password;
        $this->isSandbox            = $isSandbox;
        $this->languageLocaleAlpha2 = $languageLocaleAlpha2;
    }

    /**
     * @return string
     */
    public function getLastRestXMLRequest() {
        return $this->lastXML;
    }

    /**
     * @param string $xml
     * @param AbstractTrackingRequest|null $request
     * @throws DhlRestCurlException
     * @throws DhlRestHttpException
     * @throws DhlXmlParseException
     */
    private function sendCurl($xml, $request = null) {
        $this->lastXML = $xml;

        $curl = curl_init($this->isSandbox ? self::SANDBOX_URL : self::PRODUCTION_URL);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: text/xml']);
        curl_setopt($curl, CURLOPT_USERPWD, $this->appID . ":" . $this->apiToken);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);

        if (curl_errno($curl)):
            throw new DhlRestCurlException(curl_error($curl), $request, $xml);
        endif;

        $this->handleHttpCodes(curl_getinfo($curl, CURLINFO_HTTP_CODE), $request, $xml);
        curl_close($curl);

        return XmlParser::parseFromXml($response);
    }

    /**
     * @param int $httpCode
     * @param AbstractTrackingRequest $request
     * @param string $xml
     *
     * @throws DhlRestHttpException
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

    /**
     * @param AbstractTrackingRequest $request
     *
     * @return AbstractTrackingRequest
     */
    private function fillRequestData($request) {
        $request->request = $request->getRequestString();

        $request->appname  = empty($request->appname) ? $this->zTToken : $request->appname;
        $request->password = empty($request->password) ? $this->password : $request->password;

        $request->languageCode = empty($request->languageCode) ? $this->languageLocaleAlpha2 : $request->languageCode;
        $request->languageCode = strtolower($request->languageCode);

        return $request;
    }

}
