<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Response\Status;

use ChristophSchaeffer\Dhl\BusinessShipping\Client;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\AbstractStatus;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\Success;
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
        $abstractStatus = $this->getMockBuilder(AbstractStatus::class)
                               ->setConstructorArgs(['testMessage', Client::LANGUAGE_LOCALE_GERMAN_DE, 9999999])
                               ->getMock()
        ;

        $this->assertEquals('testMessage', $abstractStatus->messageRaw);
        $this->assertEquals(9999999, $abstractStatus->code);
    }

    public function testConstructorTranslation() {
        $status = new Success('testMessage', Client::LANGUAGE_LOCALE_GERMAN_DE, 9999999);
        $this->assertEquals($this->getProtectedPropertyValue($status, 'messageGerman'), $status->message);

        $statusEn = new Success('testMessage', Client::LANGUAGE_LOCALE_ENGLISH_GB, 9999999);
        $this->assertEquals($this->getProtectedPropertyValue($statusEn, 'messageEnglish'), $statusEn->message);
    }

    /**
     * @throws \ReflectionException
     */
    public function testTranslateMessage() {
        $status = new Success('testMessage', Client::LANGUAGE_LOCALE_GERMAN_DE, 9999999);
        $this->setProtectedPropertyValue($status, 'messageGerman', 'deutsch');
        $this->setProtectedPropertyValue($status, 'messageEnglish', 'english');

        $translated = $status->translateMessage(Client::LANGUAGE_LOCALE_GERMAN_DE);
        $this->assertEquals('deutsch', $translated);

        $translated = $status->translateMessage(Client::LANGUAGE_LOCALE_ENGLISH_GB);
        $this->assertEquals('english', $translated);

        $translated = $status->translateMessage('asdf');
        $this->assertFalse($translated);
    }
}
