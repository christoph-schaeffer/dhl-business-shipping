<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class InvalidParameter
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidParameter extends IncorrectRequest {

    public    $code           = 122;

    protected $messageEnglish = 'The information in the request is incorrect. A parameter is invalid.';

    protected $messageGerman  = 'Die Angaben im Request sind inkorrekt. Ein Parameter ist ungültig.';

    public    $text           = 'Invalid parameter';

}