<?php

namespace Tests\Functional;

use Gigya\GSRequest;
use Tests\BaseTest;

/**
 * Class AuthenticationTest
 * @package Tests\Functional
 */
class AuthenticationTest extends BaseTest
{
    public function testAuth()
    {
        $params = ['loginID' => 'gerard.cao.ext@francetv.fr', 'password' => 'testtest'];
        $request = new GSRequest($this->apiKey, $this->secretKey, 'accounts.login', null, true);

        foreach ($params as $key => $val) {
            $request->setParam($key, $val);
        }

        $response = $request->send();
        $this->assertEquals(0, $response->getErrorCode());
    }
}