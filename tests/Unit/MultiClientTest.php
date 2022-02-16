<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\ShippingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\TrackingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Rest;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Soap;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Response;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource;
use ChristophSchaeffer\Dhl\BusinessShipping\ShippingClient;
use ChristophSchaeffer\Dhl\BusinessShipping\TrackingClient;

/**
 * Class MultiClientTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit
 */
class MultiClientTest extends AbstractUnitTest {

    /**
     * @throws \ReflectionException
     * @throws \SoapFault
     */
    public function testConstruct() {
        $client = $this->getClient();
        $shippingClient = $this->getProtectedPropertyValue($client, 'shippingClient');
        $this->assertInstanceOf(ShippingClient::class, $shippingClient);
        $this->assertEquals(MultiClient::LANGUAGE_LOCALE_GERMAN_DE, $this->getProtectedPropertyValue($shippingClient, 'languageLocale'));

        $soap = $this->getProtectedPropertyValue($shippingClient, 'soap');
        $this->assertInstanceOf(Soap::class, $soap);
        $this->assertEquals('https://cig.dhl.de/services/sandbox/soap', $soap->location);
        $this->assertEquals('appIDTest', $soap->_login);
        $this->assertEquals('apiTokenTest', $soap->_password);

        $soapHeader = $soap->__default_headers[0];
        $this->assertEquals('loginTest', $soapHeader->data['user']);
        $this->assertEquals('passwordTest', $soapHeader->data['signature']);

        $trackingClient = $this->getProtectedPropertyValue($client, 'trackingClient');
        $this->assertInstanceOf(TrackingClient::class, $trackingClient);
        $this->assertEquals('de', $this->getProtectedPropertyValue($trackingClient, 'languageLocaleAlpha2'));
        $this->assertEquals($this->getTrackingClientCredentials(), $this->getProtectedPropertyValue($trackingClient, 'credentials'));

        $rest = $this->getProtectedPropertyValue($trackingClient, 'rest');

        $this->assertInstanceOf(Rest::class, $rest);
        $this->assertEquals(TRUE, $this->getProtectedPropertyValue($rest, 'isSandbox'));
    }

    public function testCreateShipmentOrder() {
        $expected = '123';
        $shippingClient = $this->getShippingClientMock('createShipmentOrder', $expected);
        $multiClient = $this->getClient($shippingClient);
        $actual = $multiClient->createShipmentOrder(new Request\Shipping\createShipmentOrder([]));
        $this->assertEquals($expected, $actual);
    }

    public function testDeleteShipmentOrder() {
        $expected = '1234';
        $shippingClient = $this->getShippingClientMock('deleteShipmentOrder', $expected);
        $multiClient = $this->getClient($shippingClient);
        $actual = $multiClient->deleteShipmentOrder(new Request\Shipping\deleteShipmentOrder([]));
        $this->assertEquals($expected, $actual);
    }

    public function testDoManifest() {
        $expected = '12345';
        $shippingClient = $this->getShippingClientMock('doManifest', $expected);
        $multiClient = $this->getClient($shippingClient);
        $actual = $multiClient->doManifest(new Request\Shipping\doManifest([]));
        $this->assertEquals($expected, $actual);
    }

    public function testGetExportDoc() {
        $expected = '123456';
        $shippingClient = $this->getShippingClientMock('getExportDoc', $expected);
        $multiClient = $this->getClient($shippingClient);
        $actual = $multiClient->getExportDoc(new Request\Shipping\getExportDoc([]));
        $this->assertEquals($expected, $actual);
    }

    public function testGetLabel() {
        $expected = '321';
        $shippingClient = $this->getShippingClientMock('getLabel', $expected);
        $multiClient = $this->getClient($shippingClient);
        $actual = $multiClient->getLabel(new Request\Shipping\getLabel([]));
        $this->assertEquals($expected, $actual);
    }

    public function testGetManifest() {
        $expected = '4321';
        $shippingClient = $this->getShippingClientMock('getManifest', $expected);
        $multiClient = $this->getClient($shippingClient);
        $actual = $multiClient->getManifest(new Request\Shipping\getManifest(''));
        $this->assertEquals($expected, $actual);
    }

    public function testGetVersion() {
        $expected = '54321';
        $shippingClient = $this->getShippingClientMock('getVersion', $expected);
        $multiClient = $this->getClient($shippingClient);
        $actual = $multiClient->getVersion(new Request\Shipping\getVersion());
        $this->assertEquals($expected, $actual);
    }

    public function testUpdateShipmentOrder() {
        $expected = '654321';
        $shippingClient = $this->getShippingClientMock('updateShipmentOrder', $expected);
        $multiClient = $this->getClient($shippingClient);
        $actual = $multiClient->updateShipmentOrder(new Request\Shipping\updateShipmentOrder('', (new Resource\ShipmentOrder())));
        $this->assertEquals($expected, $actual);
    }

    public function testValidateShipment() {
        $expected = '22';
        $shippingClient = $this->getShippingClientMock('validateShipment', $expected);
        $multiClient = $this->getClient($shippingClient);
        $actual = $multiClient->validateShipment(new Request\Shipping\validateShipment([]));
        $this->assertEquals($expected, $actual);
    }

    public function testGetStatusForPublicUser() {
        $expected = 'abc';
        $trackingClient = $this->getTrackingClientMock('getStatusForPublicUser', $expected);
        $multiClient = $this->getClient(null, $trackingClient);
        $actual = $multiClient->getStatusForPublicUser(new Request\Tracking\getStatusForPublicUser([]));
        $this->assertEquals($expected, $actual);
    }

    public function testGetPieceDetail() {
        $expected = 'abcd';
        $trackingClient = $this->getTrackingClientMock('getPieceDetail', $expected);
        $multiClient = $this->getClient(null, $trackingClient);
        $actual = $multiClient->getPieceDetail(new Request\Tracking\getPieceDetail());
        $this->assertEquals($expected, $actual);
    }

    public function testGetPiece() {
        $expected = 'abcde';
        $trackingClient = $this->getTrackingClientMock('getPiece', $expected);
        $multiClient = $this->getClient(null, $trackingClient);
        $actual = $multiClient->getPiece(new Request\Tracking\getPiece());
        $this->assertEquals($expected, $actual);
    }

    public function testGetPieceEvents() {
        $expected = 'cba';
        $trackingClient = $this->getTrackingClientMock('getPieceEvents', $expected);
        $multiClient = $this->getClient(null, $trackingClient);
        $actual = $multiClient->getPieceEvents(new Request\Tracking\getPieceEvents());
        $this->assertEquals($expected, $actual);
    }

    public function testGetSignature() {
        $expected = 'dcba';
        $trackingClient = $this->getTrackingClientMock('getSignature', $expected);
        $multiClient = $this->getClient(null, $trackingClient);
        $actual = $multiClient->getSignature(new Request\Tracking\getSignature());
        $this->assertEquals($expected, $actual);
    }

    /**
     * @param string $functionToMock
     * @param string $return
     * @return ShippingClient|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getShippingClientMock($functionToMock, $return) {
        $shippingClient = $this->getMockBuilder(ShippingClient::class)
            ->setConstructorArgs([$this->getShippingClientCredentials(), TRUE])
            ->setMethods([$functionToMock])
            ->getMock();
        $shippingClient->method($functionToMock)
            ->willReturn($return);

        return $shippingClient;
    }

    /**
     * @param string $functionToMock
     * @param string $return
     * @return TrackingClient|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getTrackingClientMock($functionToMock, $return) {
        $trackingClient = $this->getMockBuilder(TrackingClient::class)
            ->setConstructorArgs([$this->getTrackingClientCredentials(), TRUE])
            ->setMethods([$functionToMock])
            ->getMock();
        $trackingClient->method($functionToMock)
            ->willReturn($return);

        return $trackingClient;
    }

    private function getShippingClientCredentials() {
        return new ShippingClientCredentials('appIDTest', 'apiTokenTest', 'loginTest', 'passwordTest');
    }

    private function getTrackingClientCredentials() {
        return new TrackingClientCredentials('appIDTest', 'apiTokenTest', 'ztTokenTest', 'passwordTest');
    }

    /**
     * @param ShippingClient $shippingClient
     * @param TrackingClient $trackingClient
     * @return MultiClient
     * @throws \SoapFault
     */
    private function getClient($shippingClient = null, $trackingClient = null) {
        return new MultiClient($this->getShippingClientCredentials(), $this->getTrackingClientCredentials(), TRUE, MultiClient::LANGUAGE_LOCALE_GERMAN_DE, $shippingClient, $trackingClient);
    }
}

?>
