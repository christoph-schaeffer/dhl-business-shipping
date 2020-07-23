<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Request;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;
use ChristophSchaeffer\Dhl\BusinessShipping\Client;

/**
 * Class AbstractRequestTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Request
 */
class AbstractRequestTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $abstractRequestMock = $this->getMockForAbstractClass(AbstractRequest::class);

        $this->assertInstanceOf(Version::class, $abstractRequestMock->Version);
        $this->assertEquals(Client::MAJOR_RELEASE, $abstractRequestMock->Version->majorRelease);
        $this->assertEquals(Client::MINOR_RELEASE, $abstractRequestMock->Version->minorRelease);
    }
}
