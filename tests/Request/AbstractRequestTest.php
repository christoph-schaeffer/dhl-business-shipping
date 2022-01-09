<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Request;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractShippingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\ShippingClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class AbstractRequestTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Request
 */
class AbstractRequestTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $abstractRequestMock = $this->getMockForAbstractClass(AbstractShippingRequest::class);

        $this->assertInstanceOf(Version::class, $abstractRequestMock->Version);
        $this->assertEquals(ShippingClient::MAJOR_RELEASE, $abstractRequestMock->Version->majorRelease);
        $this->assertEquals(ShippingClient::MINOR_RELEASE, $abstractRequestMock->Version->minorRelease);
    }
}
