<?php

use Buttress\IRC\Action\ActionManager;
use Buttress\IRC\Action\CallableAction;
use Buttress\IRC\Connection\Connection;
use Buttress\IRC\Logger\CLILogger;
use Buttress\IRC\Message\MessageFactory;

class ConnectionTest extends \PHPUnit_Framework_TestCase
{

    protected $factory;
    protected $manager;
    protected $connection;

    public function testLog()
    {
        $this->connection->setLogger(new CLILogger());

        ob_start();
        $this->connection->log('test');
        $this->assertContains('test' . PHP_EOL, ob_get_contents());
        ob_end_clean();
    }

    public function testConnect()
    {
        $this->connection->connect();

        $this->assertFalse($this->connection->isConnected());
    }

    public function testRead()
    {
        $hit = "";
        $action = new CallableAction(
            function ($message) use (&$hit) {
                $message->getConnection()->disconnect();
                $hit = $message->getRaw();
            }, function ($connection) {
                fwrite($connection->getSocket(), 'TEST');
                rewind($connection->getSocket());
            });

        $this->manager->add('*', $action);

        $this->connection->connect();

        $this->assertEquals('TEST', $hit);
    }

    public function testDoubleConnect()
    {
        $hit = true;
        $action = new CallableAction(
            function ($message) use (&$hit) {
                $hit = $message->getConnection()->connect();
                $message->getConnection()->disconnect();
            }, function ($connection) {
                fwrite($connection->getSocket(), 'TEST');
                rewind($connection->getSocket());
            });

        $this->manager->add('*', $action);
        $this->connection->connect();

        $this->assertFalse($hit);
    }

    protected function setUp()
    {
        $this->factory = new MessageFactory();
        $this->manager = new ActionManager($this->factory);
        $this->connection = new Connection($this->manager, '127.0.0.1', 80);

    }

    protected function tearDown()
    {
        $this->connection->disconnect();
    }

}
