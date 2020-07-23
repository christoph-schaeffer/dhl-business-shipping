<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;


/**
 * Class AccountNumberNotAvailable
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class AccountNumberNotAvailable extends HardValidationError {

    protected $messageEnglish = 'The specified account number is not available.';

    protected $messageGerman  = 'Die ausgewählte Abrechnungsnummer steht nicht zur Verfügung.';

}