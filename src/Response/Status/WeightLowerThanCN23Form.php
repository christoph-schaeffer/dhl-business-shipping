<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class WeightLowerThanCN23Form
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class WeightLowerThanCN23Form extends HardValidationError {

    protected $messageEnglish = 'The weight you have entered is lower than specified in the CN23-Form.';

    protected $messageGerman  = 'Die Gewichtsangabe ist kleiner als im CN23-Formular angegeben wurde.';

}
