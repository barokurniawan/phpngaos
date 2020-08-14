<?php

namespace phpngaos\Bootstrap;

use Yosymfony\Toml\Toml;

class Config
{
    private static $instance;
    private $kv;

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->kv = Toml::ParseFile(__DIR__ . '/../../app.toml');
    }

    public function getValue(string $key)
    {
        if (!isset($this->kv[$key])) {
            return null;
        }

        return $this->kv[$key];
    }

    public static function get(string $key)
    {
        return self::getInstance()->getValue($key);
    }
}
