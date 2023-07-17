<?php

namespace Core\Mailer;

class Mailer
{
    private static array $_dsn = [
        'mailer_dsn'    => '',
    ];

    public static function getMailerDsn($key) : ?string
    {
        if(!isset(self::$_dsn[$key])) {
            return null;
        }

        return self::$_dsn[$key];
    }
}