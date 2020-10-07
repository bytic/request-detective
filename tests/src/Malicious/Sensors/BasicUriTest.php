<?php

namespace ByTIC\RequestDetective\Tests\Malicious\Sensors;

use ByTIC\RequestDetective\Malicious\Sensors\BasicUri;
use ByTIC\RequestDetective\Tests\AbstractTest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BasicUriTest
 * @package ByTIC\RequestDetective\Tests\Malicious\Sensors
 */
class BasicUriTest extends AbstractTest
{
    public function test_check()
    {
        $request = Request::create('/wp-admin/test');
        self::assertTrue(BasicUri::check($request));

        $request = Request::create('/my/url');
        self::assertFalse(BasicUri::check($request));
    }

    public function testGetMaliciousUriArray()
    {
        self::assertGreaterThanOrEqual(10, count(BasicUri::getMaliciousUriArray()));
    }

    public function testGetPathFromRequest()
    {
        $request = Request::create('/wp-admin/');
        self::assertSame('/wp-admin/', BasicUri::getPathFromRequest($request));
    }
}
