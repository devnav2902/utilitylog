# Utilitylog - Write a custom message in laravel log

This package help you write a custom log message, customize based on LineFormatter - [Monolog](https://github.com/Seldaek/monolog)

## Installation

Install the latest version with command:

> composer require devnav2902/utilitylog

## Basic Usage

```php
UtilityLog::writeLog('error', 'Foo');
UtilityLog::writeLog('info', 'Bar');

// in try-catch block
try {
     throw new \Exception('Something happened!');
} catch (\Throwable $th) {
     UtilityLog::writeLog('error', 'Error in try-catch block', $th);
}

// contextual information
UtilityLog::writeLog('info', 'User {id} failed to login.', null, ['id' => $user->id]);
```
## Documentation
### Usage Instructions

This package use LineFormatter (Monolog), so you can set a custom format like this:
> "[%channel%][%level_name%] %datetime%\n%message% %extra%\n\n"

You can modify in config file, here is default config:

```php
<?php

return [
    'customize_formatter' => "[%channel%][%level_name%] %datetime%\n%message% %extra%\n\n",
    'date_format' => 'Y-m-d H:i:s',
    'message_json_option' => JSON_PRETTY_PRINT,
    'allow_inline_linebreaks' => true,
    'ignore_empty_context_and_extra' => true,
    'include_stacktraces' => false
];
```

This use for params of LineFormatter:

```php
class CustomizeFormatter
{
    /**
     * Customize the given logger instance.
     */
    public function __invoke(Logger $logger): void
    {
        foreach ($logger->getHandlers() as $handler) {
            $lineFormatter = new LineFormatter(
                config('utilitylog.customize_formatter'),
                config('utilitylog.date_format'),
                config('utilitylog.allow_inline_linebreaks'),
                config('utilitylog.ignore_empty_context_and_extra'),
                config('utilitylog.include_stacktraces')
            );
            
            $handler->setFormatter($lineFormatter);
        }
    }
}
```

:writing_hand: If you want to change default of config, you can use a command:

> php artisan vendor:publish --tag=utilitylog-config

This will copy file from package to your laravel project folder `config\utilitylog.php`.

:writing_hand: You can view log file in `storage\logs` by go to url: `/view-log` or `/view-log?date=Y-m-d` with Y-m-d is date format, example: 2024-05-01, this will open file: `laravel-2024-05-01.log`.

You can customize view by publish view use this command:

> php artisan vendor:publish --tag=utilitylog-views

## About
### Requirements
This package works with PHP `8.1` or above.

## License
Utilitylog is licensed under the MIT License - see the [LICENSE](https://github.com/devnav2902/utilitylog/blob/main/LICENSE) file for details
