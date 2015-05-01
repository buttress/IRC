<?php
namespace Buttress\IRC\Action;

use Buttress\IRC\Connection\ConnectionInterface;
use Buttress\IRC\Message\MessageInterface;
use Buttress\IRC\Message\PingMessage;
use Buttress\IRC\Message\PongMessage;

class PingAction implements ActionInterface
{

    public function handleConnect(ConnectionInterface $connection)
    {
        return;
    }

    public function handleMessage(MessageInterface $message)
    {
        if ($message instanceof PingMessage) {
            $message->getConnection()->sendMessage(new PongMessage($message));
        }
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
