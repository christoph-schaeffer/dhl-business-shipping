<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class AuthentificationFailed
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class AuthentificationFailed extends AuthorizationFailure {

    public    $code           = 111;

    protected $messageEnglish = 'The user of the web service could not be authenticated. User not known or password incorrect.';

    protected $messageGerman  = 'Der Nutzer des Webservice konnte nicht authentifiziert werden. Nutzer nicht bekannt, oder Passwort nicht korrekt.';

    public    $text           = 'Authentification failed';

}