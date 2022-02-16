<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\TrackingClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class AbstractTrackingResponse
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 */
abstract class AbstractTrackingResponse extends AbstractResponse {

    /**
     * @var string
     *
     * The request id. Example: 229fdf4c-6255-4cf4-947c-8441a85baaf9
     */
    public $requestId;
    /**
     * @var int
     *
     * Error status code for the current request
     *
     * For more information check the following url (you need to be authenticated on entwickler.dhl.de)
     * https://entwickler.dhl.de/group/ep/wsapis/sendungsverfolgung/allgemeinefehlerhandhabung
     *
     * 0 = successful
     */
    public $code;
    /**
     * @var string
     *
     * Used for error messages. This is null when there is no error. However, please use the hasNoErrors functions in the
     * response object for error checking.
     */
    public $error;
    /**
     * @param AbstractTrackingRequest $request
     * @param \SimpleXMLElement $rawResponse
     * @param string $rawRequest
     * @param string $languageLocale
     *
     * AbstractTrackingResponse constructor.
     */
    public function __construct(AbstractTrackingRequest $request, \SimpleXMLElement $rawResponse, $rawRequest, $languageLocale) {
        parent::__construct($request, $rawResponse, $rawRequest, $languageLocale);
        $this->Version->majorRelease = TrackingClient::MAJOR_RELEASE;
        $this->Version->minorRelease = TrackingClient::MINOR_RELEASE;
        XmlParser::mapXmlAttributesToObjectProperties($rawResponse, $this);
        $this->code = XmlParser::nullableStringTypeCast('int', $this->code);
        if($this->code !== 0 && empty($this->error)) {
            $this->error = $languageLocale === 'de' ? 'Es ist ein unbekannter Fehler aufgetreten' : 'An unknown error occurred';
        }
    }

    /**
     * @return bool
     */
    public function hasNoErrors() {
        return empty($this->error) && $this->code === 0;
    }

}