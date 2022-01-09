<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractShippingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractShippingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class AbstractResponseTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Response
 */
class AbstractResponseTest extends AbstractUnitTest {

    /**
     * @return array[]
     */
    public function providerFirstStatusIsSuccess() {
        return [
            [[(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], TRUE],
            [[(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('Der Webservice wurde ohne Fehler ausgeführt.', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], TRUE],
            [[], FALSE],
            [[(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyProduct('Bitte geben Sie ein Produkt an.', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], FALSE],
            [[(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyProduct('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], FALSE],
            [
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyProduct('Bitte geben Sie ein Produkt an.', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ], FALSE
            ],
            [
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyProduct('Bitte geben Sie ein Produkt an.', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ], TRUE
            ],
            [
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyProduct('Bitte geben Sie ein Produkt an.', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\HardValidationError('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ], TRUE
            ],
            [
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\HardValidationError('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyProduct('Bitte geben Sie ein Produkt an.', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ], FALSE
            ],
            [
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyProduct('Bitte geben Sie ein Produkt an.', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\HardValidationError('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ], FALSE
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function providerHasNoErrors() {
        return [
            [(object)['statusMessage' => 'ok'], TRUE],
            [(object)['statusMessage' => 'Der Webservice wurde ohne Fehler ausgeführt.'], TRUE],
            [(object)['statusMessage' => 'Der Webservice wurde ohne Fehler ausgeführt.', 'statusText' => 'ok'], TRUE],
            [(object)['statusMessage' => ' '], FALSE],
            [(object)['statusMessage' => 'Bitte geben Sie ein Produkt an.'], FALSE],
            [(object)['statusText' => 'Connection failure'], FALSE],
            [(object)['statusCode' => 2010, 'statusText' => 'Illegal Shipment State'], FALSE],
            [(object)['statusMessage' => ['ok', 'Bitte geben Sie ein Produkt an.']], FALSE],
            [(object)['statusText' => 'ok', 'statusMessage' => 'Connection failure'], FALSE],
            [(object)['statusMessage' => 'ok', 'statusCode' => 2010], FALSE],
            [(object)['statusMessage' => [' ', 'ok']], FALSE],
            [(object)['statusMessage' => ['Bitte geben Sie ein Produkt an.', 'ok']], FALSE],
            [(object)['statusCode' => 2010, 'statusMessage' => ['ok', 'Bitte geben Sie ein Produkt an.'], 'statusText' => 'ok'], FALSE]
        ];
    }

    /**
     *
     */
    public function testConstruct() {
        $request      = $this->getMockForAbstractClass(AbstractShippingRequest::class);
        $soapResponse = $this->mockSoapResponse();

        $responseMock = $this->getMockForAbstractClass(AbstractShippingResponse::class,
                                                       [
                                                           $request, $soapResponse, 'requestTest',
                                                           MultiClient::LANGUAGE_LOCALE_GERMAN_DE
                                                       ]);

        $this->assertEquals($soapResponse, $responseMock->rawResponse);
        $this->assertEquals('requestTest', $responseMock->rawRequest);
        $this->assertEquals($request, $responseMock->request);

        $this->assertInstanceOf(Version::class, $responseMock->Version);
        $this->assertEquals(3, $responseMock->Version->majorRelease);
        $this->assertEquals(0, $responseMock->Version->minorRelease);

        $this->assertEquals([(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $responseMock->Status);
    }

    /**
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus[] $statusArray
     * @param                         $expectedResult
     *
     * @dataProvider providerFirstStatusIsSuccess
     *
     * @throws \ReflectionException
     */
    public function testFirstStatusIsSuccess(array $statusArray, $expectedResult) {
        $request      = $this->getMockForAbstractClass(AbstractShippingRequest::class);
        $soapResponse = $this->mockSoapResponse();

        $responseMock = $this->getMockForAbstractClass(AbstractShippingResponse::class,
                                                       [
                                                           $request, $soapResponse, 'requestTest',
                                                           MultiClient::LANGUAGE_LOCALE_GERMAN_DE
                                                       ]);

        $actualResult = $this->runProtectedMethod(
            $responseMock,
            'firstStatusIsSuccess',
            [$statusArray]
        );

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrors
     */
    public function testHasNoErrors($statusObject, $expectedResult) {
        $request              = $this->getMockForAbstractClass(AbstractShippingRequest::class);
        $soapResponse         = $this->mockSoapResponse();
        $soapResponse->Status = $statusObject;

        $responseMock = $this->getMockForAbstractClass(AbstractShippingResponse::class,
                                                       [
                                                           $request, $soapResponse, 'requestTest',
                                                           MultiClient::LANGUAGE_LOCALE_GERMAN_DE
                                                       ]);

        $actualResult = $responseMock->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return object
     */
    private function mockSoapResponse() {
        return (object)[
            'Version' => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'  => (object)[
                'statusMessage' => 'ok'
            ]
        ];
    }
}
