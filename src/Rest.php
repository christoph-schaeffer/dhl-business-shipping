<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping;


use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking\RequestData;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class Rest
 * @package ChristophSchaeffer\Dhl\BusinessShipping
 *
 * This is the main class of this plugin, which is used to call function of the api.
 */
class Rest
{

    const PRODUCTION_URL = 'https://cig.dhl.de/services/production/rest/sendungsverfolgung';
    const SANDBOX_URL = 'https://cig.dhl.de/services/sandbox/rest/sendungsverfolgung';

    private $appID;
    private $apiToken;
    private $zTToken;
    private $password;
    private $isSandbox;
    private $languageLocaleAlpha2;

    /**
     * @param RequestData $requestData
     * @param object[] $contentObjects
     */
    public function callFunction($requestData, $contentObjects = [])
    {
        $requestData = $this->fillRequestData($requestData);

        $xml = '<?xml version="1.0" encoding="UTF-8" ?>';
        $xmlContent = '';
        foreach ($contentObjects as $contentObject) {
            $xmlContent .= XmlParser::parseToXml($contentObject);
        }
        $xml .= XmlParser::parseToXml($requestData, $xmlContent);

        var_dump($xml);
        return $this->sendCurl($xml);
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
        $this->appID = $appID;
        $this->apiToken = $apiToken;
        $this->zTToken = $zTToken;
        $this->password = $password;
        $this->isSandbox = $isSandbox;
        $this->languageLocaleAlpha2 = $languageLocaleAlpha2;
    }

    /**
     * @param string $xml
     */
    private function sendCurl($xml) {
        $curl = curl_init($this->isSandbox ? self::SANDBOX_URL : self::PRODUCTION_URL);
        curl_setopt ($curl, CURLOPT_HTTPHEADER, ['Content-Type: text/xml']);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_USERPWD, $this->appID . ":" . $this->apiToken);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);

        if(curl_errno($curl)){
            throw new \Exception(curl_error($curl));
        }

        var_dump($response);

        curl_close($curl);

        return 'asdf'; //@TODO implement curl request
    }

    /**
     * @param RequestData $requestData
     *
     * @return RequestData
     */
    private function fillRequestData($requestData)
    {
        $requestData->appname = empty($requestData->appname) ? $this->zTToken : $requestData->appname;
        $requestData->password = empty($requestData->password) ? $this->password : $requestData->password;
        $requestData->languageCode = empty($requestData->languageCode) ? $this->languageLocaleAlpha2 : $requestData->languageCode;
        $requestData->languageCode = strtolower($requestData->languageCode);

        return $requestData;
    }

}
