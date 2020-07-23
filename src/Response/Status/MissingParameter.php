<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class MissingParameter
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class MissingParameter extends IncorrectRequest {

    public    $code           = 121;

    protected $messageEnglish = 'The information in the request is incorrect. A parameter is missing.';

    protected $messageGerman  = 'Die Angaben im Request sind inkorrekt. Es fehlt ein Parameter.';

    public    $text           = 'Missing parameter';

}