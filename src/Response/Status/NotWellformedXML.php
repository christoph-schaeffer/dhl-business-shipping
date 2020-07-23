<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class NotWellformedXML
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class NotWellformedXML extends RequestProcessingFailure {

    public    $code           = 11;

    protected $messageEnglish = 'An error occurred while parsing. There are usually basic XML errors, such as missing closing elements, use of <> / & in content, possibly also character set coding errors.';

    protected $messageGerman  = 'Beim Parsen ist ein Fehler aufgetreten. In der Regel bestehen grundlegende XML-Fehler, wie z.B. fehlende schließende Elemente, Verwendung von <>/& in Inhalten, ggf. auch Zeichensatzencodingfehlern.';

    public    $text           = 'Not well formed XML';

}