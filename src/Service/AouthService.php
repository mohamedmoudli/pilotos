<?php

/*
 * This file is part of the FOSOAuthServerBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use OAuth2\OAuth2;
use OAuth2\OAuth2ServerException;

class AouthService
{

    protected $server;


    public function __construct(OAuth2 $server)
    {
        $this->server = $server;
    }


    public function tokenAction(Request $request)
    {
        try {
            return $this->server->grantAccessToken($request);
        } catch (OAuth2ServerException $e) {
            return $e->getHttpResponse();
        }
    }
}
