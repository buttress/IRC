<?php
namespace Buttress\IRC\Action;

use Buttress\IRC\Connection\ConnectionInterface;
use Buttress\IRC\Message\MessageInterface;
use Psr\Log\LogLevel;

class ErrorAction implements ActionInterface
{

    /**
     * We can ignore this
     *
     * @param ConnectionInterface $connection
     * @return mixed|void
     */
    public function handleConnect(ConnectionInterface $connection)
    {
        return;
    }

    /**
     * We need to disconnect, we encountered an error
     *
     * @param MessageInterface $message
     */
    public function handleMessage(MessageInterface $message)
    {
        $message->getConnection()->log(
            sprintf('Error: %s', implode(' ', $message->getParams())),
            array(),
            LogLevel::DEBUG);
        $message->getConnection()->disconnect();
    }

    /**
     * Handle repeated function calls
     * @return void
     */
    public function handleTick()
    {
        return;
    }
}
