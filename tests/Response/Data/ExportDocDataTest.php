<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Response\Data;

use ChristophSchaeffer\Dhl\BusinessShipping\Client;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Data\ExportDocData;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class ExportDocDataTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Response\Data
 */
class ExportDocDataTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstructWithEmptyExportDocData() {
        $exportDocDataResponse = $this->mockEmptyExportDocDataResponse();
        $exportDocData         = new ExportDocData(Client::LANGUAGE_LOCALE_GERMAN_DE, $exportDocDataResponse);

        $this->assertEquals((new ExportDocData(Client::LANGUAGE_LOCALE_GERMAN_DE)), $exportDocData);
    }

    /**
     *
     */
    public function testConstructWithFilledExportDocData() {
        $exportDocDataResponse = $this->mockFilledExportDocDataResponse();
        $exportDocData         = new ExportDocData(Client::LANGUAGE_LOCALE_GERMAN_DE, $exportDocDataResponse);

        $this->assertInstanceOf(ExportDocData::class, $exportDocData);
        $this->assertCount(1, $exportDocData->Status);
        $this->assertEquals((new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE)), array_shift($exportDocData->Status));
        $this->assertEquals('exportDocBase64', $exportDocData->exportDocData);
        $this->assertEquals('exportDocUrl', $exportDocData->exportDocUrl);
        $this->assertFalse(property_exists($exportDocData, 'newProp'));
    }

    /**
     *
     */
    public function testConstructWithFilledExportDocURL() {
        $exportDocDataResponse = $this->mockFilledExportDocDataResponse();
        unset($exportDocDataResponse->exportDocUrl);
        $exportDocDataResponse->exportDocURL = 'exportDocURL';
        $exportDocData                       = new ExportDocData(Client::LANGUAGE_LOCALE_GERMAN_DE, $exportDocDataResponse);

        $this->assertInstanceOf(ExportDocData::class, $exportDocData);
        $this->assertCount(1, $exportDocData->Status);
        $this->assertEquals((new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE)), array_shift($exportDocData->Status));
        $this->assertEquals('exportDocBase64', $exportDocData->exportDocData);
        $this->assertEquals('exportDocURL', $exportDocData->exportDocUrl);
        $this->assertFalse(property_exists($exportDocData, 'newProp'));
    }

    /**
     *
     */
    public function testConstructWithNullExportDocData() {
        $exportDocDataResponse = $this->mockNullExportDocDataResponse();
        $exportDocData         = new ExportDocData(Client::LANGUAGE_LOCALE_GERMAN_DE, $exportDocDataResponse);

        $this->assertEquals((new ExportDocData(Client::LANGUAGE_LOCALE_GERMAN_DE)), $exportDocData);
    }

    /**
     * @return object
     */
    private function mockEmptyExportDocDataResponse() {
        return (object)[];
    }

    /**
     * @return object
     */
    private function mockFilledExportDocDataResponse() {
        return (object)[
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'exportDocData' => 'exportDocBase64',
            'exportDocUrl'  => 'exportDocUrl',
            'newProp'       => 'should not exist'
        ];
    }

    /**
     * @return NULL
     */
    private function mockNullExportDocDataResponse() {
        return NULL;
    }
}
