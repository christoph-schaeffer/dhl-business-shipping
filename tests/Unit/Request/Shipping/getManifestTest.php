<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Request\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;

/**
 * Class getManifestTest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Request\Shipping
 */
class getManifestTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $request = new \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getManifest('2020-01-01');

        $this->assertInstanceOf(Version::class, $request->Version);
        $this->assertNotEmpty($request->Version);
        $this->assertTrue(is_string($request->manifestDate));
        $this->assertEquals('2020-01-01', $request->manifestDate);

    }
}
