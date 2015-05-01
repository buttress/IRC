<?php
namespace Buttress\IRC\Action;

use Buttress\IRC\Connection\ConnectionInterface;
use Buttress\IRC\Message\MessageInterface;
use Buttress\IRC\Message\PingMessage;
use Buttress\IRC\Message\PongMessage;

class PingAction extends AbstractAction
{

    public function handleMessage(MessageInterface $message)
    {
        if ($message instanceof PingMessage) {
            $message->getConnection()->sendMessage(new PongMessage($message));
        }
    }

}