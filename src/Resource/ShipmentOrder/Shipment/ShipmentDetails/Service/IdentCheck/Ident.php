<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service\IdentCheck;

/**
 * Class Ident
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service\IdentCheck
 *
 * Identity data which needs to be checked
 */
class Ident {

    const MINIMUM_AGE_16 = 'A16';
    const MINIMUM_AGE_18 = 'A18';

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 255
     *
     * Surname (family name) of the person for ident check.
     */
    public $surname;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 255
     *
     * Given name (first name) of the person for ident check.
     */
    public $givenName;

    /**
     * @var string
     *
     * Format: YYYY-MM-DD
     *
     * Min length: 10
     * Max length: 10
     *
     * Date of birth (DOB) of the person for ident check.
     */
    public $dateOfBirth;

    /**
     * @var string
     *
     * Optional
     *
     * Choose between the following two
     * A16: 16 and above
     * A18: 18 and above
     *
     * Minimum age of the person for ident check
     */
    public $minimumAge;


}