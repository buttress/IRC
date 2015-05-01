<?php
namespace Buttress\IRC\Action;

use Buttress\IRC\Connection\ConnectionInterface;
use Buttress\IRC\Message\MessageInterface;
use Psr\Log\LogLevel;

class ErrorAction extends AbstractAction
{

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

}
