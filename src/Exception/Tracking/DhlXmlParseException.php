<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Exception\DhlException;

/**
 * Class DhlXmlParseException
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking
 * @codeCoverageIgnore
 *
 * This exception is thrown on xml parsing failures. For example a not well-formed xml string was given which can't be parsed.
 */
class DhlXmlParseException extends DhlException {

    /** @var string */
    private $xmlStringToParse;

    /**
     * @param string $xmlStringToParse
     * @param string $message
     * @param int $code
     * @param Object $previous
     */
    public function __construct($xmlStringToParse, $message = "DHL XML parse error", $code = 0, $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->xmlStringToParse = $xmlStringToParse;
    }

    /**
     * @return string
     */
    public function getXmlStringToParse() {
        return $this->xmlStringToParse;
    }


}
