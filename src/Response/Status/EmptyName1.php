<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyName1
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyName1 extends HardValidationError {

    protected $messageEnglish = 'Please enter name 1.';

    protected $messageGerman  = 'Bitte geben Sie Name 1 an.';

}