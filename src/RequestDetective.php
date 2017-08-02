<?php

namespace ByTIC\RequestDetective;

use ByTIC\RequestDetective\Malicious\MaliciousDetective;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestDetective
 * @package ByTIC\RequestDetective
 */
class RequestDetective
{

    /**
     * @param Request $request
     * @return bool
     */
    public static function isMalicious($request)
    {
        return MaliciousDetective::check($request);
    }
}
