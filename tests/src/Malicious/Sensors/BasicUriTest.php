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
    /**
     * @dataProvider data_check
     */
    public function test_check($uri, $result)
    {
        $request = Request::create($uri);
        self::assertSame($result, BasicUri::check($request));
    }

    public function data_check(): array
    {
        return [
            ['/wp-admin/test', true],
            ['/web/wp-includes/wlwmanifest.xml', true],
            ['/my/url', false],
        ];
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
