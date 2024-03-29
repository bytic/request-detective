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
        $uri = strtolower(self::getPathFromRequest($request));
        $uriLen = strlen($uri);
        $maliciousUris = self::getMaliciousUriArray();

        foreach ($maliciousUris as $maliciousUri) {
            $pos = strpos($uri, $maliciousUri);
            if ($pos === 0) {
                return true;
            }
            if ($pos > 0 && $pos == ($uriLen - strlen($maliciousUri))) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public static function getMaliciousUriArray(): array
    {
        return array_merge(
            self::getGenericList(),
            self::getWordpressList(),
            self::getEditorsList(),
            self::getLoginList(),
            self::getWaletsList(),
            self::getVendorsList()
        );
    }

    /**
     * Get the current path info for the request.
     *
     * @param Request $request
     * @return string
     */
    public static function getPathFromRequest($request): string
    {
        $pattern = ltrim($request->getPathInfo(), '/');
        return $pattern == '' ? '/' : '/' . $pattern;
    }

    /**
     * @return array
     */
    public static function getWordpressList(): array
    {
        return [
            '/wp',
            '/wp.php',
            '/wordpress',
            '/wp-admin',
            '/old/wp-admin',
            '/wp/wp-admin',
            '/blog/wp-admin',
            '/test/wp-admin',
            '/wp-includes',
            '/wp-content',
            '/xmlrpc.php',
            '/xmlrp.php',
            '/wp-login.php',
            '/wordpress',
            '/wlwmanifest.xml',
            '/beence.php'
        ];
    }

    public static function getVendorsList(): array
    {
        return [
            '/config/aws.yml',
            '/.well-known',
            '/.aws'
        ];
    }

    /**
     * @return array
     */
    public static function getGenericList(): array
    {
        return [
            '/upload.php',
            '/admin.php',
            '/defau1t.php',
            '/new.php',
            '/xox.php',
            '/xleet.php',
            '/xleet-shell.php',
            '/mini.php',
            '/ups.php',
            '/config.php',
            '/openserver',
            '/recordings',
            '/webdav',
            '/phpmyadmin',
            '/wikindex.php',
            '/license.txt',
            '/hetlerx.php',
            '/ads.txt',
            '/data/admin',
            '/latest/dynamic',
            '/e/admin',
            '/.fk.php',
            '/f.php',
            '/ffAA531.php',
            '/4price.php',
            '/vendor/composer',
            '/vendor/phpunit',
            '/old-index.php',

        ];
    }

    /**
     * @return array
     */
    public static function getEditorsList(): array
    {
        return [
            '/fckeditor/editor',
            '/vbulletin/ajax/render',
            '/ajax/render/widget_tabbedcontainer_tab_panel',
        ];
    }

    /**
     * @return array
     */
    public static function getWaletsList(): array
    {
        return [
            '/index.php/bitcoin/wallet.dat',
            '/index.php/backup/wallet.dat',
            '/index.php/bitcoin/backup/wallet.dat',
        ];
    }

    public static function getLoginList(): array
    {
        return [
            '/sitecore/shell/clientbin/reporting/report.ashx',
            '/telerik.web.ui.webresource.axd',
            '/owa/auth/logon.aspx',
        ];
    }
}
