<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class InsufficientRight
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InsufficientRight extends AuthorizationFailure {

    public    $code           = 112;

    protected $messageEnglish = 'When executing the web service operation, the authenticated user did not have sufficient rights to carry out the operation or an attempt was made to perform an operation on an object (data record) for which the user does not have the rights';

    protected $messageGerman  = 'Beim Ausführen der Webservice Operation hat der authentifizierte Nutzer nicht die ausreichenden Rechte um die Operation auszuführen oder es wurde versucht eine Operation auf ein Objekt (Datensatz) auszuführen, für die er die Rechte nicht besitzt';

    public    $text           = 'Insufficent right';

}