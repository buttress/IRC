<?php

use Buttress\IRC\Action\ActionManager;
use Buttress\IRC\Action\PingAction;
use Buttress\IRC\Connection\Connection;
use Buttress\IRC\Message\MessageFactory;

class PongMessageTest extends PHPUnit_Framework_TestCase
{

    protected $factory;
    protected $manager;
    protected $connection;
    protected $socket;

    public function testPong()
    {
        $this->connection->handleRaw('PING :test.ping');
        rewind($this->socket);

        $result = fgets($this->socket);

        $this->assertEquals('PONG :test.ping' . PHP_EOL, $result);
    }

    protected function setUp()
    {
        $this->factory = new MessageFactory();
        $this->manager = new ActionManager($this->factory);
        $this->connection = new Connection($this->manager, '');

        $this->socket = fopen('php://temp', 'rw');
        $this->connection->setSocket($this->socket);

        $this->manager->add('PING', new PingAction());
    }

    protected function tearDown()
    {
        fclose($this->socket);
    }

}
