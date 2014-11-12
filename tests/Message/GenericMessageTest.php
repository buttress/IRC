<?php

use Buttress\IRC\Message\GenericMessage;
use Buttress\IRC\Message\MessageFactory;

class GenericMessageTest extends PHPUnit_Framework_TestCase
{

    public function testSetter()
    {
        $factory = new MessageFactory();

        $message = $factory->make('test');
        $message->setPrefix($set = uniqid());

        $this->assertEquals($message->getPrefix(), $set);
    }

    public function testGetRaw()
    {
        $message = new GenericMessage('test', 'prefix', array(1, 2, 3));

        $this->assertEquals(':prefix TEST 1 2 :3', $message->getRaw());
    }

}
