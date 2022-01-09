<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;

/**
 * Class Status
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 *
 * Status objects which have been returned. Those objects can be found in src/Status
 */
abstract class AbstractStatus {

    /**
     * @var int
     *
     * Overall status of the entire request: A value of zero means, the request was processed without error. A value
     * greater than zero indicates that an error occurred.
     */
    public $code;

    /**
     * @var string
     *
     * Explanation of the status code and potential errors in the client defined language
     */
    public $message;

    /**
     * @var string
     *
     * Explanation of the status code and potential errors, as received from the DHL API, usually in german.
     */
    public $messageRaw;

    /**
     * @var string
     *
     * Explanation of the status code and potential errors. This usually contains a message of the error group. For
     * example hard error or weak error. But nothing specific about the actual error that has happened. Use message
     * or messageGerman for specific user-friendly responses.
     */
    public $text;

    /**
     * @var string
     *
     * Explanation of the status code and potential errors in english
     */
    protected $messageEnglish;

    /**
     * @var string
     *
     * Explanation of the status code and potential errors in german
     */
    protected $messageGerman;

    /**
     * AbstractStatus constructor.
     *
     * @param string $messageRaw
     * @param string $languageLocale
     * @param int    $code
     */
    public function __construct($messageRaw, $languageLocale, $code = NULL) {
        $this->message    = $this->translateMessage($languageLocale);
        $this->messageRaw = $messageRaw;

        if(!empty($code))
            $this->code = $code;
    }

    /**
     * @param string $languageLocale
     *
     * @return bool|string
     *
     * Use this method to translate the status message after the response has been built.
     */
    public function translateMessage($languageLocale) {
        switch ($languageLocale):
            case MultiClient::LANGUAGE_LOCALE_GERMAN_DE:
                return $this->messageGerman;
            case MultiClient::LANGUAGE_LOCALE_ENGLISH_GB:
                return $this->messageEnglish;
            default:
                return FALSE;
        endswitch;
    }

}