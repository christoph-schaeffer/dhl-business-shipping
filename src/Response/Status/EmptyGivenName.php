<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyGivenName
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyGivenName extends HardValidationError {

    protected $messageEnglish = 'Please check your details. The first name field is a mandatory field and must be filled.';

    protected $messageGerman  = 'Bitte überprüfen Sie Ihre Angaben. Das Feld Vorname ist ein Pflichtfeld und muss befüllt werden.';

}