<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class UnknownPackstationNumber
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class UnknownPackstationNumber extends WeakValidationError {

    protected $messageEnglish = 'The Packstation number you have entered is not known, yet. Please check the Packstation number and the entered post code. In some cases it may be that a new Packstation is not yet known.';

    protected $messageGerman  = 'Die Packstationsnummer ist uns aktuell nicht bekannt. Bitte überprüfen Sie die Nummer und die Postleitzahl. Es kann in Einzelfällen sein, dass eine neue Packstation noch nicht bekannt ist.';

}