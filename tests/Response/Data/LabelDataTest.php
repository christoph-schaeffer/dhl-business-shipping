<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Response\Data;

use ChristophSchaeffer\Dhl\BusinessShipping\Client;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Data\LabelData;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class LabelDataTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Response\Data
 */
class LabelDataTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstructWithEmptyLabelData() {
        $labelDataResponse = $this->mockEmptyLabelDataResponse();
        $labelData         = new LabelData(Client::LANGUAGE_LOCALE_GERMAN_DE, $labelDataResponse);

        $this->assertEquals((new LabelData(Client::LANGUAGE_LOCALE_GERMAN_DE)), $labelData);
    }

    /**
     *
     */
    public function testConstructWithFilledLabelData() {
        $labelDataResponse = $this->mockFilledLabelDataResponse();
        $labelData         = new LabelData(Client::LANGUAGE_LOCALE_GERMAN_DE, $labelDataResponse);

        $this->assertInstanceOf(LabelData::class, $labelData);
        $this->assertCount(1, $labelData->Status);
        $this->assertEquals((new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE)), array_shift($labelData->Status));
        $this->assertEquals('codBase64', $labelData->codLabelData);
        $this->assertEquals('codUrl', $labelData->codLabelUrl);
        $this->assertEquals('labelBase64', $labelData->labelData);
        $this->assertEquals('labelUrl', $labelData->labelUrl);
        $this->assertEquals('exportBase64', $labelData->exportLabelData);
        $this->assertEquals('exportUrl', $labelData->exportLabelUrl);
        $this->assertEquals('returnBase64', $labelData->returnLabelData);
        $this->assertEquals('returnUrl', $labelData->returnLabelUrl);
        $this->assertFalse(property_exists($labelData, 'newProp'));
    }

    /**
     *
     */
    public function testConstructWithNullLabelData() {
        $labelDataResponse = $this->mockNullLabelDataResponse();
        $labelData         = new LabelData(Client::LANGUAGE_LOCALE_GERMAN_DE, $labelDataResponse);

        $this->assertEquals((new LabelData(Client::LANGUAGE_LOCALE_GERMAN_DE)), $labelData);
    }

    /**
     * @return object
     */
    private function mockEmptyLabelDataResponse() {
        return (object)[];
    }

    /**
     * @return object
     */
    private function mockFilledLabelDataResponse() {
        return (object)[
            'Status'          => (object)[
                'statusMessage' => 'ok'
            ],
            'codLabelData'    => 'codBase64',
            'codLabelUrl'     => 'codUrl',
            'labelData'       => 'labelBase64',
            'labelUrl'        => 'labelUrl',
            'exportLabelData' => 'exportBase64',
            'exportLabelUrl'  => 'exportUrl',
            'returnLabelData' => 'returnBase64',
            'returnLabelUrl'  => 'returnUrl',
            'newProp'         => 'should not exist'
        ];
    }

    /**
     * @return NULL
     */
    private function mockNullLabelDataResponse() {
        return NULL;
    }
}
