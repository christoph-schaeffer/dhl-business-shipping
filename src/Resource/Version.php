<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource;

/**
 * Class Version
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource
 *
 * The version of the webservice implementation for which the requesting client is developed.
 */
class Version {

    /**
     * @var string
     *
     * Min length: 1
     * Max length: 2
     *
     * The number of the major release. E.g. the '3' in version "3.0".
     */
    public $majorRelease;

    /**
     * @var string
     *
     * Min length: 1
     * Max length: 2
     *
     * The number of the minor release. E.g. the '0' in version "3.0".
     */
    public $minorRelease;
}