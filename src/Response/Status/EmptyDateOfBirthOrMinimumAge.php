<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;


/**
 * Class EmptyDateOfBirthOrMinimumAge
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyDateOfBirthOrMinimumAge extends HardValidationError {

    protected $messageEnglish = 'Please check your details in date of birth and / or minimum age. At least one of these fields must be filled. An entry in both fields is also allowed.';

    protected $messageGerman  = 'Bitte überprüfen Sie Ihre Angaben in Geburtsdatum und/oder Mindestalter. Mindestens eines dieser Felder muss befüllt werden. Eine Angabe in beiden Feldern ist ebenfalls zulässig.';

}