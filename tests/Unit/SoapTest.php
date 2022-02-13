<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit;

use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Soap;

/**
 * Class SoapTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit
 */
class SoapTest extends AbstractUnitTest {

    /**
     * @throws \SoapFault
     */
    public function testConstructProduction() {
        $this->assertFileIsReadable(Soap::WSDL_PATH);
        $soap = new Soap('appIDTest', 'apiTokenTest', 'loginTest', 'passwordTest', FALSE);

        $this->assertInstanceOf(\SoapClient::class, $soap);
        $this->assertEquals('https://cig.dhl.de/services/production/soap', $soap->location);
        $this->assertEquals('appIDTest', $soap->_login);
        $this->assertEquals('apiTokenTest', $soap->_password);

        $soapHeader = $soap->__default_headers[0];
        $this->assertInstanceOf(\SoapHeader::class, $soapHeader);
        $this->assertEquals('http://dhl.de/webservice/cisbase', $soapHeader->namespace);
        $this->assertEquals('Authentification', $soapHeader->name);
        $this->assertEquals('loginTest', $soapHeader->data['user']);
        $this->assertEquals('passwordTest', $soapHeader->data['signature']);
    }

    /**
     * @throws \SoapFault
     */
    public function testConstructSandbox() {
        $this->assertFileIsReadable(Soap::WSDL_PATH);
        $soap = new Soap('appIDTest', 'apiTokenTest', 'loginTest', 'passwordTest', TRUE);

        $this->assertInstanceOf(\SoapClient::class, $soap);
        $this->assertEquals('https://cig.dhl.de/services/sandbox/soap', $soap->location);
        $this->assertEquals('appIDTest', $soap->_login);
        $this->assertEquals('apiTokenTest', $soap->_password);

        $soapHeader = $soap->__default_headers[0];
        $this->assertInstanceOf(\SoapHeader::class, $soapHeader);
        $this->assertEquals('http://dhl.de/webservice/cisbase', $soapHeader->namespace);
        $this->assertEquals('Authentification', $soapHeader->name);
        $this->assertEquals('loginTest', $soapHeader->data['user']);
        $this->assertEquals('passwordTest', $soapHeader->data['signature']);
    }

    /**
     * @throws \ReflectionException
     * @throws \SoapFault
     */
    public function testGetStatusClassByMessage() {
        $soapHeader = $this->runProtectedMethod(
            (new Soap('', '', '', '')),
            'constructSoapHeader',
            ['Username123', 'super-secret-password']
        );

        $this->assertInstanceOf(\SoapHeader::class, $soapHeader);
        $this->assertEquals('http://dhl.de/webservice/cisbase', $soapHeader->namespace);
        $this->assertEquals('Authentification', $soapHeader->name);
        $this->assertEquals('Username123', $soapHeader->data['user']);
        $this->assertEquals('super-secret-password', $soapHeader->data['signature']);
    }

}

?>