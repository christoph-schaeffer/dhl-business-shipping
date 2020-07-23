<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class MissingDimension
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class MissingDimension extends HardValidationError {

    protected $messageEnglish = 'If one of the dimensions is specified, all must be specified.';

    protected $messageGerman  = 'Wird eine der Abmessungen angegeben, müssen alle angegeben werden.';

}