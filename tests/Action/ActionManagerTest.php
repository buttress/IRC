<?php

use Buttress\IRC\Action\ActionManager;
use Buttress\IRC\Connection\Connection;
use Buttress\IRC\Message\MessageFactory;

class ActionManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testHandleConnect()
    {
        $mock = $this->getMock('\Buttress\IRC\Action\ActionInterface');
        $mock->expects($this->once())->method('handleConnect');

        $factory = new MessageFactory();
        $manager = new ActionManager($factory, $mock);

        $manager->handleConnect(new Connection($manager, ''));
    }
}
