<?php

namespace phpngaos\Bootstrap;

class Session
{
    private static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $message)
    {
        self::getInstance();
        $_SESSION[$key] = $message;
    }

    public static function get($key, $removeAfter = false)
    {
        self::getInstance();
        $val = $_SESSION[$key];

        if ($removeAfter) {
            unset($_SESSION[$key]);
        }

        return $val;
    }

    public static function getFlash($key)
    {
        return Session::get($key, true);
    }

    public static function clear()
    {
        session_destroy();
        session_start();
    }
}
