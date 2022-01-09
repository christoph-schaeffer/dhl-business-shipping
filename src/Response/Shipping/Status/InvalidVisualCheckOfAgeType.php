<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class InvalidVisualCheckOfAgeType
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidVisualCheckOfAgeType extends HardValidationError {

    protected $messageEnglish = 'The selected type of visual age test is not valid. Possible values: A16 or A18.';

    protected $messageGerman  = 'Der gewählte Typ der Alterssichtprüfung ist nicht gültig. Mögliche Werte: A16 oder A18.';

}