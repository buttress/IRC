<?php

use Buttress\IRC\Action\CTCPAction;
use Buttress\IRC\Message\MessageFactory;

class CTCPActionTest extends \PHPUnit_Framework_TestCase
{

    public function testVersion()
    {
        $mock = $this->getMock('\Buttress\IRC\Connection\ConnectionInterface');
        $mock->expects($this->once())->method('sendMessage');

        $factory = new MessageFactory();
        $message = $factory->getMessageFromRaw(
            ":Korvin!~korvin@concrete5/79063/Korvin PRIVMSG Buttress :\001VERSION\001");
        $message->setConnection($mock);

        $action = new CTCPAction();

        $action->handleConnect($mock);
        $action->handleMessage($message);
    }

    public function testPing()
    {
        $mock = $this->getMock('\Buttress\IRC\Connection\ConnectionInterface');
        $mock->expects($this->once())->method('sendMessage');

        $factory = new MessageFactory();
        $message = $factory->getMessageFromRaw(
            ":Korvin!~korvin@concrete5/79063/Korvin PRIVMSG Buttress :\001PING test\001");
        $message->setConnection($mock);

        $action = new CTCPAction();

        $action->handleConnect($mock);
        $action->handleMessage($message);
    }

    public function testTime()
    {
        $mock = $this->getMock('\Buttress\IRC\Connection\ConnectionInterface');
        $mock->expects($this->once())->method('sendMessage');

        $factory = new MessageFactory();
        $message = $factory->getMessageFromRaw(
            ":Korvin!~korvin@concrete5/79063/Korvin PRIVMSG Buttress :\001TIME test\001");
        $message->setConnection($mock);

        $action = new CTCPAction();

        $action->handleConnect($mock);
        $action->handleMessage($message);
    }

    public function testUnsupported()
    {
        $mock = $this->getMock('\Buttress\IRC\Connection\ConnectionInterface');
        $mock->expects($this->exactly(0))->method('sendMessage');

        $factory = new MessageFactory();
        $message = $factory->getMessageFromRaw(
            ":Korvin!~korvin@concrete5/79063/Korvin PRIVMSG Buttress :\001UNSUPPORTED test\001");
        $message->setConnection($mock);

        $action = new CTCPAction();

        $action->handleConnect($mock);
        $action->handleMessage($message);
    }

}
