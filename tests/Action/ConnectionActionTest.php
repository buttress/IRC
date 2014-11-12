<?php

use Buttress\IRC\Action\ConnectionAction;

class ConnectionActionTest extends \PHPUnit_Framework_TestCase
{

    public function testHandleConnect()
    {
        $mock = $this->getMock('\Buttress\IRC\Connection\ConnectionInterface');
        $mock->expects($this->exactly(3))->method('sendMessage');

        $action = new ConnectionAction('nick', '#channel');
        $action->handleConnect($mock);
        $action->handleMessage($this->getMock('\Buttress\IRC\Message\MessageInterface'));
    }

}
