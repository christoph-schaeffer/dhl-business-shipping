<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class AbstractTrackingRequest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 */
abstract class AbstractTrackingRequest extends AbstractRequest {

    public $contentObjects = [];
    /**
     * @var string
     *
     * Contains the "ZT-Kennung". Only DHL knows why the property is called appname instead of ztKennung.
     *
     * This is set automatically, you can however overwrite it.
     */
    public $appname;
    /**
     * @var string
     *
     * Contains the password for the entered "ZT-Kennung".
     *
     * This is set automatically, you can however overwrite it.
     */
    public $password;
    /**
     * @var string
     *
     * language code in ISO 3166-1 (Alpha 2) e.g. de, fr, es
     */
    public $languageCode;

    /**
     * @var string
     *
     * This is the request name e.g. "d-get-piece", however this is filled automatically by this library. Please do not
     * set this field as it will be overwritten anyway.
     */
    public $request;

    public function __construct() {
    }

    public abstract function getRequestString();

}
