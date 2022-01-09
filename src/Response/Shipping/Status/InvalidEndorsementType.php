<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class InvalidEndorsementType
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidEndorsementType extends HardValidationError
{

    protected $messageEnglish = 'The selected type of advance directive is not valid.';

    protected $messageGerman = 'Die ausgewählte Art der Vorausverfügung ist nicht gültig.';

}
