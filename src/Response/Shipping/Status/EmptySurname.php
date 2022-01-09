<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class EmptySurname
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptySurname extends HardValidationError {

    protected $messageEnglish = 'Please check your details. The surname field is a mandatory field and must be filled.';

    protected $messageGerman  = 'Bitte überprüfen Sie Ihre Angaben. Das Feld Nachname ist ein Pflichtfeld und muss befüllt werden.';

}