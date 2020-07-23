<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class ValueHasBeenShortened
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class ValueHasBeenShortened extends WeakValidationError {

    protected $messageEnglish = 'The entered value is to long and has been shortened.';

    protected $messageGerman  = 'Der eingegebene Wert ist zu lang und wurde gekürzt.';

}