<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class UnknownPostfilialNumber
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class UnknownPostfilialNumber extends WeakValidationError {

    protected $messageEnglish = 'The entered Postfilial number is currently unknown to us. Please check the Postfilial number and the entered post code. In some cases it may be that a new Postfiliale has not yet been registered.';

    protected $messageGerman  = 'Die eingegebene Filialnummer ist uns aktuell nicht bekannt. Bitte überprüfen Sie die Nummer und die Postleitzahl. Es kann in Einzelfällen sein, dass eine neue Filiale noch nicht hinterlegt ist.';

}