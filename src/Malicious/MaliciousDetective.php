<?php

namespace ByTIC\RequestDetective\Malicious;

use ByTIC\RequestDetective\Malicious\Sensors\BasicUri;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MaliciousDetective
 * @package ByTIC\RequestDetective\Malicious
 */
class MaliciousDetective
{
    /**
     * @param Request $request
     * @return bool
     */
    public static function check($request)
    {
        if (!BasicUri::check($request)) {
            return false;
        }
        return true;
    }
}
