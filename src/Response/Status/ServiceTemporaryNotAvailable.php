<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class ServiceTemporaryNotAvailable
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class ServiceTemporaryNotAvailable extends AbstractStatus {

    public    $code           = 500;

    protected $messageEnglish = 'Service temporary not available.';

    protected $messageGerman  = 'Der service steht temporär nicht zur verfügung.';

    public    $text           = 'Service temporary not available';

}