<?php
namespace Buttress\IRC\Message;

class PongMessage extends GenericMessage
{

    public function __construct(PingMessage $message)
    {
        $this->params = $message->getParams();
    }

    public function getCommand()
    {
        return "PONG";
    }

}
