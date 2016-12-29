<?php

namespace ByTIC\RequestDetective\Malicious\Sensors;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class BasicUri
 * @package ByTIC\RequestDetective
 */
class BasicUri
{
    /**
     * @param Request $request
     * @return bool
     */
    static public function check($request)
    {
        $uri = self::getPathFromRequest($request);
        if (in_array($uri, self::getMaliciousUriArray())) {
            return true;
        }
        return false;

    }

    /**
     * @return array
     */
    static public function getMaliciousUriArray()
    {
        return self::getGenericList() + self::getWordpressList();
    }

    /**
     * Get the current path info for the request.
     *
     * @param Request $request
     * @return string
     */
    public function getPathFromRequest($request)
    {
        $pattern = trim($request->getPathInfo(), '/');
        return $pattern == '' ? '/' : '/' . $pattern;
    }

    /**
     * @return array
     */
    static public function getWordpressList()
    {
        return [
            '/wp-login.php',
            '/wp-admin/',
            '/xmlrpc.php',
            '/old/wp-admin/',
            '/wp/wp-admin/',
            '/wordpress/wp-admin/',
            '/blog/wp-admin/',
            '/test/wp-admin/',
        ];
    }

    /**
     * @return array
     */
    static public function getGenericList()
    {
        return [
            '/openserver/',
            '/recordings/LICENSE.txt',
            '/webdav/',
            '/license.txt',
            '/hetlerx.php',
        ];
    }
}