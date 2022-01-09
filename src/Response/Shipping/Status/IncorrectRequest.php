<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class IncorrectRequest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class IncorrectRequest extends GeneralFailure {

    public    $code           = 120;

    protected $messageEnglish = 'The information in the request is incorrect.';

    protected $messageGerman  = 'Die Angaben im Request sind inkorrekt.';

    public    $text           = 'Incorrect request';

}