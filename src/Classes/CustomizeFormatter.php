<?php
 
namespace Devnav2902\Utilitylog\Classes;
 
use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;
 
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