<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\TrackingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlNotAvailableInSandbox;
use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Rest;
use ChristophSchaeffer\Dhl\BusinessShipping\TrackingClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Response;

/**
 * Class TrackingClientTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit
 */
class TrackingClientTest extends AbstractUnitTest {

    const APP_ID = 'appIDTest';
    const API_TOKEN = 'apiTokenTest';
    const ZT_TOKEN = 'ztTokenTest';
    const PASSWORD = 'passwordTest';

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function testConstructWithDefaultValues() {
        $client = $this->getTrackingClient();
        $this->assertEquals('de', $this->getProtectedPropertyValue($client, 'languageLocaleAlpha2'));
        $this->assertEquals($this->getCredentials(), $this->getProtectedPropertyValue($client, 'credentials'));

        $rest = $this->getProtectedPropertyValue($client, 'rest');
        $this->assertInstanceOf(Rest::class, $rest);
        $this->assertEquals(FALSE, $this->getProtectedPropertyValue($rest, 'isSandbox'));
        $this->assertEquals(self::APP_ID, $this->getProtectedPropertyValue($rest, 'appID'));
        $this->assertEquals(self::API_TOKEN, $this->getProtectedPropertyValue($rest, 'apiToken'));

        $credentials = $this->getProtectedPropertyValue($client, 'credentials');
        $this->assertInstanceOf(TrackingClientCredentials::class, $credentials);
        $this->assertEquals(self::ZT_TOKEN, $credentials->ztToken);
        $this->assertEquals(self::PASSWORD, $credentials->password);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function testConstructWithEnglishLocale() {
        $client = $this->getTrackingClient(TRUE, MultiClient::LANGUAGE_LOCALE_ENGLISH_GB);
        $this->assertEquals('en', $this->getProtectedPropertyValue($client, 'languageLocaleAlpha2'));
        $this->assertEquals($this->getCredentials(), $this->getProtectedPropertyValue($client, 'credentials'));

        $rest = $this->getProtectedPropertyValue($client, 'rest');
        $this->assertInstanceOf(Rest::class, $rest);
        $this->assertEquals(TRUE, $this->getProtectedPropertyValue($rest, 'isSandbox'));
        $this->assertEquals(self::APP_ID, $this->getProtectedPropertyValue($rest, 'appID'));
        $this->assertEquals(self::API_TOKEN, $this->getProtectedPropertyValue($rest, 'apiToken'));

        $credentials = $this->getProtectedPropertyValue($client, 'credentials');
        $this->assertInstanceOf(TrackingClientCredentials::class, $credentials);
        $this->assertEquals(self::ZT_TOKEN, $credentials->ztToken);
        $this->assertEquals(self::PASSWORD, $credentials->password);
    }



    public function testConstructWithGermanLocale() {
        $client = $this->getTrackingClient(TRUE, MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $this->assertEquals('de', $this->getProtectedPropertyValue($client, 'languageLocaleAlpha2'));
        $this->assertEquals($this->getCredentials(), $this->getProtectedPropertyValue($client, 'credentials'));

        $rest = $this->getProtectedPropertyValue($client, 'rest');
        $this->assertInstanceOf(Rest::class, $rest);
        $this->assertEquals(TRUE, $this->getProtectedPropertyValue($rest, 'isSandbox'));
        $this->assertEquals(self::APP_ID, $this->getProtectedPropertyValue($rest, 'appID'));
        $this->assertEquals(self::API_TOKEN, $this->getProtectedPropertyValue($rest, 'apiToken'));

        $credentials = $this->getProtectedPropertyValue($client, 'credentials');
        $this->assertInstanceOf(TrackingClientCredentials::class, $credentials);
        $this->assertEquals(self::ZT_TOKEN, $credentials->ztToken);
        $this->assertEquals(self::PASSWORD, $credentials->password);
    }

    public function testGetStatusForPublicUserInSandbox() {
        $client = $this->getTrackingClient(TRUE);
        $this->expectException(DhlNotAvailableInSandbox::class);
        $client->getStatusForPublicUser((new Request\Tracking\getStatusForPublicUser([])));
    }

    /**
     * @param ?bool $isSandbox
     * @param ?string $languageLocale
     * @return TrackingClient
     */
    private function getTrackingClient($isSandbox = null, $languageLocale = null) {
        $credentials = $this->getCredentials();
        if($isSandbox === null && $languageLocale === null):
            $client = new TrackingClient($credentials);
        elseif($isSandbox === null):
            $client = new TrackingClient($credentials, $isSandbox);
        else:
            $client = new TrackingClient($credentials, $isSandbox, $languageLocale);
        endif;

        return $client;
    }

    /**
     * @return TrackingClientCredentials
     */
    private function getCredentials() {
        return new TrackingClientCredentials(self::APP_ID, self::API_TOKEN, self::ZT_TOKEN, self::PASSWORD);
    }
}

?>
