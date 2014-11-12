<?php
namespace Buttress\IRC\Connection;

use Buttress\IRC\Action\ActionManagerInterface;
use Buttress\IRC\Message\MessageInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Connection implements ConnectionInterface
{

    protected $connected = false;

    /**
     * @type resource
     */
    protected $socket;
    protected $server;
    protected $port;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ActionManagerInterface
     */
    protected $manager;

    public function __construct(ActionManagerInterface $manager, $server, $port = 6667)
    {
        $this->server = $server;
        $this->port = $port;
        $this->manager = $manager;
    }

    public function connect()
    {
        if ($this->isConnected()) {
            return false;
        }

        $this->log("Connecting to {$this->server} : {$this->port}");

        $this->connected = true;
        $this->connectionLoop();

        return true;
    }

    /**
     * @return bool
     */
    public function isConnected()
    {
        return !!$this->connected;
    }

    public function log($message, $context = array(), $level = LogLevel::NOTICE)
    {
        if ($this->logger) {
            $this->logger->log($level, $message, $context);
        }
    }

    protected function connectionLoop()
    {
        $socket = $this->getSocket();
        if (!$socket) {
            $this->socket = $socket = pfsockopen($this->server, $this->port);
            $this->manager->handleConnect($this);
        }

        while ($this->isConnected() && !feof($socket)) {
            $raw = fgets($socket);

            if ($raw) {
                $this->handleRaw($raw);
            }
        }

        $this->disconnect();
    }

    /**
     * @return resource
     */
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * @param resource $socket
     */
    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    public function handleRaw($raw)
    {
        $this->log($raw, array(), 'debug');
        $this->manager->handleRaw($this, $raw);
    }

    /**
     * @return bool
     */
    public function disconnect()
    {
        if ($this->connected && $socket = $this->getSocket()) {
            fclose($socket);
        }

        $this->log('Disconnected.');

        $this->socket = null;
        $this->connected = false;
    }

    /**
     * @param MessageInterface $message
     * @return bool
     */
    public function sendMessage(MessageInterface $message)
    {
        $this->sendRaw($message->getRaw());
    }

    /**
     * @param string $raw
     * @return bool
     */
    public function sendRaw($raw)
    {
        $this->log("Sending {$raw}");
        fwrite($this->getSocket(), $raw . PHP_EOL);
    }

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

}
