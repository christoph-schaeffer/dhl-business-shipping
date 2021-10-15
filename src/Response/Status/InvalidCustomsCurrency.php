<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;


/**
 * Class InvalidCustomsCurrency
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidCustomsCurrency extends HardValidationError {

    protected $messageEnglish = 'The specified currency is not valid.';

    protected $messageGerman  = 'Die angegebene Währung ist nicht gültig.';

}
