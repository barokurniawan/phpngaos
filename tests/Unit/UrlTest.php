<?php

use phpngaos\Bootstrap\Url;
use phpngaos\Bootstrap\Config;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    public function testMake()
    {
        $actual = Url::Make("/users");
        $expected = Config::get('app_address') . "/users";

        $this->assertEquals($expected, $actual);
    }
}
