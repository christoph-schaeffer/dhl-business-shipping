<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\TrackingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Rest;
use ChristophSchaeffer\Dhl\BusinessShipping\TrackingClient;

/**
 * Class TrackingClientTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit
 */
class TrackingClientTest extends AbstractUnitTest {

    /**
     * @throws \ReflectionException
     * @throws \SoapFault
     */
    public function testConstruct() {

        $credentials = new TrackingClientCredentials('appIDTest', 'apiTokenTest', 'ztTokenTest', 'passwordTest');
        $clientEn = new TrackingClient($credentials, TRUE, MultiClient::LANGUAGE_LOCALE_ENGLISH_GB);

        $this->assertEquals('en', $this->getProtectedPropertyValue($clientEn, 'languageLocaleAlpha2'));

        $client = new TrackingClient($credentials, TRUE);
        $this->assertEquals('de', $this->getProtectedPropertyValue($client, 'languageLocaleAlpha2'));

        $rest = $this->getProtectedPropertyValue($client, 'rest');

        $this->assertInstanceOf(Rest::class, $rest);
        $this->assertEquals(TRUE, $this->getProtectedPropertyValue($rest, 'isSandbox'));
        $this->assertEquals('appIDTest', $this->getProtectedPropertyValue($rest, 'appID'));
        $this->assertEquals('apiTokenTest', $this->getProtectedPropertyValue($rest, 'apiToken'));
    }


}

?>
