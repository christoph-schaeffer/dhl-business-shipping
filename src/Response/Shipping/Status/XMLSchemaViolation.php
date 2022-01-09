<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class XMLSchemaViolation
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class XMLSchemaViolation extends RequestProcessingFailure {

    public    $code           = 12;

    protected $messageEnglish = 'The XML does not correspond to the referenced schema.';

    protected $messageGerman  = 'Das XML entspricht nicht dem referenzierten  Schema.';

    public    $text           = 'XML schema violation';

}