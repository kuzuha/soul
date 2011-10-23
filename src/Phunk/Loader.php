<?php

namespace Phunk;

class Loader
{
    /**
     * @static
     * @param array $options
     * @return Handler
     */
    static function auto(array $options = array())
    {
        switch (PHP_SAPI) {
            case 'cli':
                if (isset($_SERVER['beat_version'])) {
                    return self::load('Beat', $options);
                }
                return self::load('BuiltinWebServer', $options);
            default:
                return self::load('Simple', $options);
        }
    }

    /**
     * @static
     * @param string $handler
     * @param array $options
     * @return Handler
     */
    static function load($handler, array $options = array())
    {
        $class = "Phunk\\Handler\\$handler";
        return new $class();
    }
}
