<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource;

/**
 * Class AbstractCommunication
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource
 *
 * Information about communication.
 */
abstract class AbstractCommunication {

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 50
     *
     * First name and last name of contact person.
     */
    public $contactPerson;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 50
     *
     * Email address.
     */
    public $email;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 20
     *
     * Phone number.
     */
    public $phone;

}