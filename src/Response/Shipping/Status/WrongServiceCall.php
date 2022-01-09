<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class WrongServiceCall
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class WrongServiceCall extends RequestProcessingFailure {

    public    $code           = 13;

    protected $messageEnglish = 'An unknown soap operation was called. The request type does not match the soap operation. ';

    protected $messageGerman  = 'Es wurde eine unbekannte Soap-Operation aufgerufen. Der Requesttyp passt nicht zu der Soap-Operation.';

    public    $text           = 'Wrong service call';

}