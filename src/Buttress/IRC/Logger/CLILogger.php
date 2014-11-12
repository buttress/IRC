<?php
namespace Buttress\IRC\Logger;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

class CLILogger extends AbstractLogger
{

    protected $debug;

    function __construct($debug = false)
    {
        $this->debug = !!$debug;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        $stamp = date("[Y-m-d H:i:s] ");
        $output = "";

        $message = trim($message);

        switch ($level) {
            case LogLevel::DEBUG:
                if ($this->debug) {
                    $output = "{$stamp} {$message}";
                }
                break;

            default:
                $output = "{$stamp} {$message}";
                break;
        }

        echo $output . PHP_EOL;

        if ($context) {
            var_dump($context);
            echo PHP_EOL;
        }
    }

}
