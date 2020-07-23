<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource;

/**
 * Class AbstractName
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource
 *
 * A name which will be printed as the first 3 lines of the address.
 */
abstract class AbstractName {

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 50
     *
     * Full name or company name
     */
    public $name1;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 50
     *
     * Full name or company name (line 2)
     */
    public $name2;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 50
     *
     * Full name or company name (line 3)
     */
    public $name3;

}