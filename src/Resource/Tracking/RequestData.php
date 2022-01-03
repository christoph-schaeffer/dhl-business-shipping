<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\TrackingClient;

/**
 * Class RequestData
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking
 *
 * Used for requests of the TrackingClient
 */
class RequestData
{
    const REQUEST_GET_STATUS_FOR_PUBLIC_USER = 'get-status-for-public-user';
    const REQUEST_GET_PIECE = 'd-get-piece';
    const REQUEST_GET_PIECE_EVENTS = 'd-get-piece-events';
    const REQUEST_GET_PIECE_DETAIL = 'd-get-piece-detail';
    const REQUEST_GET_SIGNATURE = 'd-get-signature';

    public $appname;
    public $password;
    public $request = self::REQUEST_GET_STATUS_FOR_PUBLIC_USER;
    public $languageCode = TrackingClient::LANGUAGE_LOCALE_ALPHA2_DE;
}
