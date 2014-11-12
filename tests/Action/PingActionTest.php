<?php

use Buttress\IRC\Action\PingAction;
use Buttress\IRC\Message\MessageFactory;

class PingActionTest extends \PHPUnit_Framework_TestCase
{

    public function testHandleMessage()
    {
        $mock = $this->getMock('\Buttress\IRC\Connection\ConnectionInterface');
        $mock->expects($this->once())->method('sendMessage');

        $factory = new MessageFactory();

        $pingAction = new PingAction();
        $pingAction->handleConnect($mock);

        $message = $factory->make('PING', '', array('testing.ping'));
        $message->setConnection($mock);

        $pingAction->handleMessage($message);
    }

}
