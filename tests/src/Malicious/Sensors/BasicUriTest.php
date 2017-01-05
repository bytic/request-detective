<?php

namespace ByTIC\RequestDetective\Tests\Malicious\Sensors;

use ByTIC\RequestDetective\Malicious\Sensors\BasicUri;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BasicUriTest
 * @package ByTIC\RequestDetective\Tests\Malicious\Sensors
 */
class BasicUriTest extends \PHPUnit_Framework_TestCase
{
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