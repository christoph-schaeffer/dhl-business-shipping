<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class InvalidEmailAddress
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidEmailAddress extends WeakValidationError {

    protected $messageEnglish = 'Please enter a valid e-mail address and use a comma to separate when entering multiple e-mail addresses. The input of umlauts is invalid. If you have entered a valid e-mail address, the recipient has objected to the receipt of e-mails by DHL. In this case it is not possible to carry out the service.';

    protected $messageGerman  = 'Bitte geben Sie eine gültige E-Mail-Adresse ein und verwenden Sie bei der Eingabe mehrerer E-Mail-Adressen ein Komma zur Trennung. Die Eingabe von Umlauten ist ungültig. Sollten Sie eine gültige E-Mail-Adresse eingegeben haben, so hat der Empfänger dem Erhalt von E-Mails durch DHL widersprochen. In diesem Fall ist es nicht möglich den Service auszuführen.';

}