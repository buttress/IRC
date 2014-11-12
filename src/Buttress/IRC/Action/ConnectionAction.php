<?php
namespace Buttress\IRC\Action;

use Buttress\IRC\Connection\ConnectionInterface;
use Buttress\IRC\Message\GenericMessage;
use Buttress\IRC\Message\MessageInterface;

class ConnectionAction implements ActionInterface {

    protected $nick;
    protected $channel;
    protected $loginName;
    protected $realName;


    public function __construct($nick, $channel, $login_name = "buttress-irc", $real_name = "buttress-irc")
    {
        $this->nick = $nick;
        $this->channel = $channel;
        $this->loginName = $login_name;
        $this->realName = $real_name;
    }

    /**
     * Handle Connection
     *
     * @param ConnectionInterface $connection
     * @return mixed
     */
    public function handleConnect(ConnectionInterface $connection)
    {
        $nick_message = new GenericMessage('NICK', '', array($this->nick));

        $user_message = new GenericMessage('USER', '', array(
            $this->loginName,
            'Host',
            'Server',
            $this->realName
        ));

        $join_message = new GenericMessage('JOIN', '', array($this->channel));

        $connection->sendMessage($nick_message);
        $connection->sendMessage($user_message);
        $connection->sendMessage($join_message);

    }

    /**
     * Handle messages
     *
     * @param MessageInterface $message
     * @return void
     */
    public function handleMessage(MessageInterface $message)
    {
        return;
    }

}
