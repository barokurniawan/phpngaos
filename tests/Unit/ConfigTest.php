<?php

use phpngaos\Bootstrap\Config;

class ConfigTest extends PHPUnit\Framework\TestCase
{
    public function testIsConfigFileExists()
    {
        $result = is_file((new Config())->getConfigPath());
        $this->assertEquals(true, $result);
    }

    public function testGetInstance()
    {
        $cfg = Config::getInstance();
        $actual = $cfg instanceof Config;

        $this->assertEquals(true, $actual);
    }

    public function testGetValue()
    {
        $cfg = Config::getInstance();
        $this->assertNotEmpty($cfg->getValue("app_name"));
    }

    public function testGet()
    {
        $this->assertNotEmpty(Config::get("app_name"));
    }
}
