<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class AbstractTrackingResponse
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response
 */
abstract class AbstractTrackingResponse extends AbstractResponse {

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
        XmlParser::mapXmlAttributesToObjectProperties($rawResponse, $this);
    }

    /**
     * @return bool
     */
    public function hasNoErrors() {
        return $this->code === 0;
    }

}