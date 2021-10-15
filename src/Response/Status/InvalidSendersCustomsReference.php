<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;


/**
 * Class InvalidSendersCustomsReference
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidSendersCustomsReference extends HardValidationError {

    protected $messageEnglish = 'The sender\'s identification number for customs purposes that you provide must contain only letters and numbers.';

    protected $messageGerman  = 'Die von Ihnen mitgegebene Kennnummer des Absenders für Zollzwecke darf nur Buchstaben und Zahlen beinhalten.';

}
