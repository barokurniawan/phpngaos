<?php

namespace phpngaos\Bootstrap;

class Url
{
    public static function Redirect($url, $permanent = false)
    {
        header('Location: ' . Url::Make($url), true, $permanent ? 301 : 302);
        exit();
    }

    public static function Make($segment)
    {
        return Config::get('app_address') . $segment;
    }
}
