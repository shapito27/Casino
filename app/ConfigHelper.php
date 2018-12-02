<?php

namespace App;

/**
 * Class ConfigHelper
 * @package App
 */
class ConfigHelper
{
    /**
     * @param string $key
     * @param string $value
     */
    public static function setEnvironmentValue(string $key, string $value)
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('='.env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }

}