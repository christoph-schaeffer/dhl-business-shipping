<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource;

/**
 * Class AbstractAddress
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource
 *
 * Address of receiver or sender
 */
abstract class AbstractAddress {

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * Address addon.
     */
    public $addressAddition;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 50
     *
     * City name.
     */

    public $city;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * Dispatching information.
     */
    public $dispatchingInformation;

    /**
     * @var AbstractOrigin
     *
     * Country.
     */
    public $Origin;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 35
     *
     * Province name.
     */
    public $province;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 50
     *
     * Name of street.
     */
    public $streetName;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 10
     *
     * House number.
     */
    public $streetNumber;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 17
     *
     * Zip code.
     */
    public $zip;

}