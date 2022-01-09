<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Response\Status;

use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class AbstractStatusTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Response\Status
 */
class AbstractStatusTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $abstractStatus = $this->getMockBuilder(\ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus::class)
                               ->setConstructorArgs(['testMessage', MultiClient::LANGUAGE_LOCALE_GERMAN_DE, 9999999])
                               ->getMock()
        ;

        $this->assertEquals('testMessage', $abstractStatus->messageRaw);
        $this->assertEquals(9999999, $abstractStatus->code);
    }

    public function testConstructorTranslation() {
        $status = new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('testMessage', MultiClient::LANGUAGE_LOCALE_GERMAN_DE, 9999999);
        $this->assertEquals($this->getProtectedPropertyValue($status, 'messageGerman'), $status->message);

        $statusEn = new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('testMessage', MultiClient::LANGUAGE_LOCALE_ENGLISH_GB, 9999999);
        $this->assertEquals($this->getProtectedPropertyValue($statusEn, 'messageEnglish'), $statusEn->message);
    }

    /**
     * @throws \ReflectionException
     */
    public function testTranslateMessage() {
        $status = new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('testMessage', MultiClient::LANGUAGE_LOCALE_GERMAN_DE, 9999999);
        $this->setProtectedPropertyValue($status, 'messageGerman', 'deutsch');
        $this->setProtectedPropertyValue($status, 'messageEnglish', 'english');

        $translated = $status->translateMessage(MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $this->assertEquals('deutsch', $translated);

        $translated = $status->translateMessage(MultiClient::LANGUAGE_LOCALE_ENGLISH_GB);
        $this->assertEquals('english', $translated);

        $translated = $status->translateMessage('asdf');
        $this->assertFalse($translated);
    }
}
