<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;


/**
 * Class InvalidAccountNumberForGivenZipCode
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidAccountNumberForGivenZipCode extends HardValidationError {

    protected $messageEnglish = 'The specified account number is invalid for the given receiver zip code.';

    protected $messageGerman  = 'Die Abrechnungsnummer ist für die Postleitzahl des Empfängers ungültig.';

}