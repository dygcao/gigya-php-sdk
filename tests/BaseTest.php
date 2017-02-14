<?php

namespace Tests;

/**
 * Class BaseTest
 * @package Tests
 */
abstract class BaseTest extends \PHPUnit\Framework\TestCase {
    protected $apiKey;
    protected $secretKey;

    protected function setUp()
    {
        $this->apiKey = getenv('gigya_apikey');
        $this->secretKey = getenv('gigya_secretkey');
    }
}