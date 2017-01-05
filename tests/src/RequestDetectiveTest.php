<?php

namespace ByTIC\RequestDetective\Tests;

use \ByTIC\RequestDetective\RequestDetective;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestDetectiveTest
 * @package ByTIC\RequestDetective\Tests
 */
class RequestDetectiveTest extends \PHPUnit_Framework_TestCase
{

    public function testIsMalicious()
    {
        $request = Request::create('/wp-admin/');
        static::assertTrue(RequestDetective::isMalicious($request));

        $request = Request::create('/controller/action');
        static::assertFalse(RequestDetective::isMalicious($request));
    }

}