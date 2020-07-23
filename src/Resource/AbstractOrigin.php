<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource;

/**
 * Class AbstractOrigin
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource
 *
 * Country
 */
abstract class AbstractOrigin {

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 30
     *
     * Name of country.
     */
    public $country;

    /**
     * @var string
     *
     * Min length: 2
     * Max length: 2
     *
     * Country's ISO-Code (ISO-2-Alpha). e.g. DE, FR, ES
     */
    public $countryISOCode;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * Name of state.
     */
    public $state;

}