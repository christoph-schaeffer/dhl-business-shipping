<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EndorsementTypeChangedFromAfterDeadlineToImmediate
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EndorsementTypeChangedFromAfterDeadlineToImmediate extends WeakValidationError {

    protected $messageEnglish = 'Please note that the "AFTER_DEADLINE (return to sender after deadline)" pre-delivery option will no longer apply. Your shipment will receive the option "IMMEDIATE (immediate return to sender)".';

    protected $messageGerman  = 'Bitte beachten Sie, dass die Vorausverfügungsoption "AFTER_DEADLINE (Rücksendung an den Absender nach Ablauf der Frist)" entfällt. Ihre Sendung erhält die Option "IMMEDIATE (sofortige Rücksendung an den Absender)".';

}
