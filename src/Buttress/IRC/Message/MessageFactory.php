<?php
namespace Buttress\IRC\Message;

use Buttress\IRC\Connection\ConnectionInterface;

class MessageFactory
{

    protected $constructors;

    public function register($command, callable $generator)
    {
        $this->constructors[$command] = $generator;
    }

    /**
     * @param string              $raw
     * @param ConnectionInterface $connection
     * @return MessageInterface
     */
    public function getMessageFromRaw($raw, ConnectionInterface $connection = null)
    {
        list($prefix, $command, $params) = $this->deconstructRaw($raw);
        $message = $this->make($command, $prefix, $params, $connection);

        return $message;
    }

    public function deconstructRaw($raw_message)
    {
        $prefix = "";

        if (substr($raw_message, 0, 1) == ':') {
            $prefix_end = strpos($raw_message, ' ');
            $prefix = substr($raw_message, 1, $prefix_end - 1);
            $raw = trim(substr($raw_message, $prefix_end + 1));
        } else {
            $raw = trim($raw_message);
        }

        $last_param = null;
        if ($last_param_pos = strpos($raw, ' :')) {
            $last_param = substr($raw, $last_param_pos + 2);
            $raw = substr($raw, 0, $last_param_pos);
        }

        $exploded = explode(' ', $raw);
        $command = array_shift($exploded);

        if ($last_param) {
            $exploded[] = $last_param;
        }

        return array($prefix, $command, $exploded);
    }

    /**
     * @param string              $command
     * @param string              $prefix
     * @param array               $params
     * @param ConnectionInterface $connection
     * @return GenericMessage
     */
    public function make($command, $prefix = "", array $params = array(), ConnectionInterface $connection = null)
    {
        $command = strtoupper($command);

        if (isset($this->constructors[$command])) {
            return $this->constructors[$command]($command, $prefix, $params, $connection);
        } else {
            $method = "construct" . substr($command, 0, 1) . substr($command, 1);
            if (method_exists($this, $method)) {
                return $this->{$method}($command, $prefix, $params, $connection);
            }
        }

        return new GenericMessage($command, $prefix, $params, $connection);
    }

    protected function constructPrivmsg($command, $prefix, $params, $connection)
    {
        return new PrivmsgMessage($prefix, $params, $connection);
    }

    protected function constructPing($command, $prefix, $params, $connection)
    {
        return new PingMessage($command, $prefix, $params, $connection);
    }

}
