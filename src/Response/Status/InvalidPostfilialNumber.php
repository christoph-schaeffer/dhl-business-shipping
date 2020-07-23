<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class InvalidPostfilialNumber
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidPostfilialNumber extends HardValidationError {

    protected $messageEnglish = 'The entered Postfilial number is invalid. Postfilial numbers are between 401 and 999. Please contact the recipient to request a correct number.';

    protected $messageGerman  = 'Die angegebene Postfilial Nummer ist ungültig. Filialnummern liegen zwischen 401 und 999. Bitte setzen Sie sich mit dem Empfänger in Verbindung, um eine korrekte Nummer zu erfragen.';

}