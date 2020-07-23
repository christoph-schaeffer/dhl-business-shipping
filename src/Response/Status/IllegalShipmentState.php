<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class IllegalShipmentState
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class IllegalShipmentState extends AbstractStatus {

    public    $code           = 2010;

    protected $messageEnglish = 'The current status of the shipment does not allow the action you want to execute (anymore).';

    protected $messageGerman  = 'Der aktuelle Status der Sendung erlaubt die Ausführung der von Ihnen gewünschte Aktion nicht (mehr).';

    public    $text           = 'Illegal Shipment State';

}