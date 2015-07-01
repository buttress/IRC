<?php
/**
 * Created by PhpStorm.
 * User: korvin
 * Date: 11/12/14
 * Time: 10:36 AM
 */

namespace Action;

use Buttress\IRC\Action\CallableAction;

class CallableActionTest extends \PHPUnit_Framework_TestCase
{

    public function testHandleMessage()
    {
        $hit = false;
        $mock = $this->getMock('\Buttress\IRC\Message\MessageInterface');

        $action = new CallableAction(
            function () use (&$hit) {
                $hit = true;
            },
            null,
            null);

        $action->handleMessage($mock);
        $this->assertTrue($hit);
    }

    public function testHandleConnect()
    {
        $hit = false;
        $mock = $this->getMock('\Buttress\IRC\Connection\ConnectionInterface');

        $action = new CallableAction(
            null,
            function () use (&$hit) {
                $hit = true;
            },
            null);

        $action->handleConnect($mock);
        $this->assertTrue($hit);
    }

    public function testHandleTick()
    {
        $hit = false;
        $mock = $this->getMock('\Buttress\IRC\Connection\ConnectionInterface');

        $action = new CallableAction(
            null,
            null,
            function () use (&$hit) {
                $hit = true;
            });

        $action->handleTick($mock);
        $this->assertTrue($hit);
    }

}
