<?php
namespace Message;

use Buttress\IRC\Message\PrivmsgMessage;

class PrivmsgMessageTest extends \PHPUnit_Framework_TestCase
{

    protected $fullUserMessage;
    protected $onlyNickMessage;
    protected $emptyMessage;

    public function setUp()
    {
        $this->fullUserMessage = new PrivmsgMessage('nick!user@host', array('Buttress', 'Hey bra'));
        $this->onlyNickMessage = new PrivmsgMessage('nick', array('Buttress', 'Hey bra'));
        $this->emptyMessage = new PrivmsgMessage('');
    }

    public function tearDown()
    {
        $this->fullUserMessage = null;
        $this->onlyNickMessage = null;
    }

    public function testGetUser()
    {
        $this->assertEquals(array('nick', 'user', 'host'), $this->fullUserMessage->getUser());
        $this->assertEquals(array('nick', '', ''), $this->onlyNickMessage->getUser());
    }

    public function testGetTo()
    {
        $this->assertEquals('Buttress', $this->fullUserMessage->getTo());
        $this->assertEquals('', $this->emptyMessage->getTo());
    }

    public function testGetMessage()
    {
        $this->assertEquals('Hey bra', $this->fullUserMessage->getMessage());
        $this->assertEquals('', $this->emptyMessage->getMessage());
    }

}
