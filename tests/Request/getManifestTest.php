<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Request;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\getManifest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class getManifestTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Request
 */
class getManifestTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $request = new getManifest('2020-01-01');

        $this->assertInstanceOf(Version::class, $request->Version);
        $this->assertNotEmpty($request->Version);
        $this->assertTrue(is_string($request->manifestDate));
        $this->assertEquals('2020-01-01', $request->manifestDate);

    }
}
