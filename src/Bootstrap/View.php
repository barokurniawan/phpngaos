<?php

namespace phpngaos\Bootstrap;

use Jenssegers\Blade\Blade;

class View extends Blade
{
    private static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new View();
        }

        return self::$instance;
    }

    public function __construct()
    {
        parent::__construct(Config::get("view_path"), Config::get("cache_path"));
    }

    public static function load(string $template, $data = [], $mergedata = [])
    {
        return self::getInstance()->make($template, $data, $mergedata);
    }
}
