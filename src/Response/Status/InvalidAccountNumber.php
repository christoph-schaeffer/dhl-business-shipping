<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;


/**
 * Class InvalidAccountNumber
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidAccountNumber extends HardValidationError {

    protected $messageEnglish = 'The selected account number is not valid or a service you have selected is not activated for your account number.';

    protected $messageGerman  = 'Die ausgewählte Abrechnungsnummer ist nicht gültig oder ein von Ihnen ausgewählter Service ist für Ihre Abrechnungsnummer nicht aktiviert.';

}