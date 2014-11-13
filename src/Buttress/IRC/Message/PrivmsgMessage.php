<?php
namespace Buttress\IRC\Message;

class PrivmsgMessage extends GenericMessage
{

    public function __construct($prefix, array $params = array(), $connection = null)
    {
        $this->command = 'PRIVMSG';
        $this->prefix = $prefix;
        $this->params = $params;
        $this->connection = $connection;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        if ($params = $this->getParams()) {
            return isset($params[0]) ? $params[0] : '';
        }
        return '';
    }

    public function getMessage()
    {
        if ($params = $this->getParams()) {
            return isset($params[1]) ? $params[1] : '';
        }
        return '';
    }

    /**
     * @return array [nick, user, host]
     */
    public function getUser() {
        $nick = "";
        $user = "";
        $host = "";

        $matches = array();
        if (preg_match('/^(?<nick>[^@!]+)(?:!(?<user>[^@]+)@(?<host>.+))?$/', $this->getPrefix(), $matches)) {
            $nick = isset($matches['nick']) ? $matches['nick'] : '';
            $user = isset($matches['user']) ? $matches['user'] : '';
            $host = isset($matches['host']) ? $matches['host'] : '';
        }

        return array($nick, $user, $host);
    }

}
