<?php

namespace Buttress\IRC\Action;


use Buttress\IRC\Connection\ConnectionInterface;
use Buttress\IRC\Message\MessageInterface;

class AbstractAction implements ActionInterface
{

    /**
     * Handle Connection
     *
     * @param ConnectionInterface $connection
     * @return mixed
     */
    public function handleConnect(ConnectionInterface $connection)
    {
        return;
    }

    /**
     * Handle messages
     *
     * @param MessageInterface $message
     * @return void
     */
    public function handleMessage(MessageInterface $message)
    {
        return;
    }

    /**
     * Handle repeated function calls
     * @param ConnectionInterface $connection
     * @return void
     */
    public function handleTick(ConnectionInterface $connection)
    {
        return;
    }

}
