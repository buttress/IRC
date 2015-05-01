<?php
namespace Buttress\IRC\Action;

use Buttress\IRC\Connection\ConnectionInterface;
use Buttress\IRC\Message\MessageInterface;

interface ActionInterface
{

    /**
     * Handle Connection
     *
     * @param ConnectionInterface $connection
     * @return mixed
     */
    public function handleConnect(ConnectionInterface $connection);

    /**
     * Handle messages
     *
     * @param MessageInterface $message
     * @return void
     */
    public function handleMessage(MessageInterface $message);

    /**
     * Handle repeated function calls
     * @return void
     */
    public function handleTick();
}
