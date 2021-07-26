<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EndorsementAfterDeadlineDeprecationWarning
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EndorsementAfterDeadlineDeprecationWarning extends WeakValidationError {

    protected $messageEnglish = 'Please note that the "AFTER_DEADLINE (return to the sender after the deadline)" option is no longer available. Your shipment has been set to the option "IMMEDIATE (immediate return to the sender)".';

    protected $messageGerman  = 'Bitte beachten Sie, dass die Vorausverfügungsoption "AFTER_DEADLINE (Rücksendung an den Absender nach Ablauf der Frist)" entfällt. Ihre Sendung erhält die Option "IMMEDIATE (sofortige Rücksendung an den Absender)".';

}
