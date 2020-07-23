<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class InvalidPackstationNumber
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidPackstationNumber extends WeakValidationError {

    protected $messageEnglish = 'The Packstation number you have entered is not known, yet. Please check the Packstation number and the entered post code. In some cases it may be that a new Packstation is not yet known. You can still generate a route coded shipment label.';

    protected $messageGerman  = 'Packstationsnummern liegen zwischen 101 und 999. Bitte setzen Sie sich mit dem Empfänger in Verbindung, um eine korrekte Nummer zu erfragen.';

}