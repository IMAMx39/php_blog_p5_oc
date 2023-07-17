<?php

namespace Core;


class Session
{

    public function __construct()
    {
        self::start();
    }

    public static function destroy() : null
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            \session_destroy();
        }
        return null;
    }
    public function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }
    public function delete($key): void
    {
        if ($this->get($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    private static function start(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            ini_set('session.use_strict_mode', 1); // Ensure strict mode
            \session_start();

        }
    }
}