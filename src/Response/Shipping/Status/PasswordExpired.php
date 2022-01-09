<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class PasswordExpired
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 *
 * The same status is being returned when the password is incorrect.
 */
class PasswordExpired extends AuthentificationFailed {

    protected $messageEnglish = 'Your password has expired.';

    protected $messageGerman  = 'Ihr Passwort ist abgelaufen.';

    public    $text           = 'Password expired';

}