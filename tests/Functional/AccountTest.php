<?php

namespace Tests\Functional;

use Gigya\GSRequest;
use Tests\BaseTest;

/**
 * Account test cases with Gigya API
 *
 * Class AccountTest
 * @package Tests\Functional
 */
class AccountTest extends BaseTest
{
    /**
     * @return array
     */
    public function testCreateAccount()
    {
        $user = ['login' => 'user.sdk.test@francetv.fr', 'password' => 'usersdk'];
        $request = new GSRequest($this->apiKey, $this->secretKey, 'accounts.initRegistration', null, true);
        $response = $request->send();

        $this->assertEquals(0, $response->getErrorCode());

        //Extract token
        $user['regToken'] = $response->getData()->getString('regToken');

        $request = new GSRequest($this->apiKey, $this->secretKey, 'accounts.register', null, true);
        $request->setParam('email', $user['login']);
        $request->setParam('password', $user['password']);
        $request->setParam('regToken', $user['regToken']);
        $request->setParam('finalizeRegistration', true);
        $response = $request->send();

        $this->assertEquals(0, $response->getErrorCode());

        return $user;
    }

    /**
     * @depends testCreateAccount
     * @param $params
     * @return array
     */
    public function testAuth($params)
    {
        $request = new GSRequest($this->apiKey, $this->secretKey, 'accounts.login', null, true);
        $request->setParam('loginID', $params['login']);
        $request->setParam('password', $params['password']);
        $response = $request->send();

        $this->assertEquals(0, $response->getErrorCode());

        return ['UID' => $response->getData()->getString('UID')];
    }

    /**
     * @depends testAuth
     * @param $params
     */
    public function testDeleteAccount($params)
    {
        $request = new GSRequest($this->apiKey, $this->secretKey, 'accounts.deleteAccount', null, true);
        $request->setParam('UID', $params['UID']);
        $response = $request->send();

        $this->assertEquals(0, $response->getErrorCode());
    }
}