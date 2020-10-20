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
    public static function check($request)
    {
        $uri = self::getPathFromRequest($request);
        $maliciousUris = self::getMaliciousUriArray();

        foreach ($maliciousUris as $maliciousUri) {
            if (strpos($uri, $maliciousUri) === 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public static function getMaliciousUriArray()
    {
        return array_merge(self::getGenericList(), self::getWordpressList(), self::getEditorsList());
    }

    /**
     * Get the current path info for the request.
     *
     * @param Request $request
     * @return string
     */
    public static function getPathFromRequest($request)
    {
        $pattern = ltrim($request->getPathInfo(), '/');
        return $pattern == '' ? '/' : '/' . $pattern;
    }

    /**
     * @return array
     */
    public static function getWordpressList()
    {
        return [
            '/xmlrpc.php',
            '/wp-login.php',
            '/wp-admin',
            '/wp-content/plugins',
            '/old/wp-admin',
            '/wp/wp-admin',
            '/wordpress',
            '/blog/wp-admin',
            '/test/wp-admin',
        ];
    }

    /**
     * @return array
     */
    public static function getGenericList()
    {
        return [
            '/openserver',
            '/recordings',
            '/webdav',
            '/phpMyAdmin',
            '/license.txt',
            '/hetlerx.php',
            '/ads.txt',
            '/data/admin/allowurl.txt',
            '/latest/dynamic/instance-identity/document',
            '/e/admin/index.php',
            '/vendor/phpunit/phpunit',
        ];
    }

    /**
     * @return array
     */
    public static function getEditorsList()
    {
        return [
            '/FCKeditor/editor/filemanager',
            '/vbulletin/ajax/render',
            '/ajax/render/widget_tabbedcontainer_tab_panel',
        ];
    }
}
