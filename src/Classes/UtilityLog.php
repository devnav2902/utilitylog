<?php

namespace Devnav2902\Utilitylog\Classes;

use Devnav2902\Utilitylog\Classes\CustomizeFormatter;
use InvalidArgumentException;
use Log;
use Throwable;
use Monolog\Level;

class UtilityLog {

    public function writeLog(string $level, string $message = '', Throwable $error = null, array $context = [])
    {
        $level = strtoupper($level);

        if (!in_array($level, Level::NAMES)) {
            throw new InvalidArgumentException('Invalid log level.');
        }

        $defaultChannel = config('logging.default');

        // $config = array_merge([
        //    'tap' => [CustomizeFormatter::class],
        // ], config("logging.channels.$defaultChannel"));
        // Log::build($config)->$level($message, $context); => not work with tap

        config([
            "logging.channels.$defaultChannel.tap" => [CustomizeFormatter::class]
        ]);

        $json = json_encode([
            'message'   => $message, 
            'level'     => $level,
            'context'   => $context,
            'source'    => $error ? [
                'message'   => $error->getMessage(),
                'function'  => $error->getTrace()[0]['function'],
                'file'      => $error->getFile(),
                'line'      => $error->getLine(),
            ] : null,
        ], config('utilitylog.message_json_option'));

        $level = strtolower($level);

        Log::$level($json, $context);
    }
}