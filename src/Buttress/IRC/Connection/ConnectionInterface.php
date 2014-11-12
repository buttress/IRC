<?php
namespace Buttress\IRC\Connection;

use Buttress\IRC\Message\MessageInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LogLevel;

interface ConnectionInterface extends LoggerAwareInterface
{

    /**
     * @return bool
     */
    public function connect();

    /**
     * @return bool
     */
    public function disconnect();

    /**
     * @return bool
     */
    public function isConnected();

    /**
     * @return resource
     */
    public function getSocket();

    /**
     * @param string $raw
     * @return bool
     */
    public function sendRaw($raw);

    /**
     * @param MessageInterface $message
     * @return bool
     */
    public function sendMessage(MessageInterface $message);

    /**
     * @param string $message
     * @param array  $context
     * @param string $level
     * @return mixed
     */
    public function log($message, $context = array(), $level = LogLevel::NOTICE);

}
