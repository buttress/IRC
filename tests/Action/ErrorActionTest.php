<?php
namespace Action;

use Buttress\IRC\Action\ErrorAction;
use Buttress\IRC\Message\GenericMessage;

class ErrorActionTest extends \PHPUnit_Framework_TestCase
{

    public function testHandleMessage()
    {
        $mock = $this->getMock('\Buttress\IRC\Connection\ConnectionInterface');
        $mock->expects($this->once())->method('disconnect');

        $action = new ErrorAction();
        $action->handleConnect($mock);

        $message = new GenericMessage('error');
        $message->setConnection($mock);
        $action->handleMessage($message);
    }

}
