<?php
namespace Buttress\IRC\Message;

use Buttress\IRC\Connection\ConnectionInterface;

class GenericMessage implements MessageInterface
{

    /**
     * @var array
     */
    protected $params;

    /**
     * @var String
     */
    protected $command;

    /**
     * @var String
     */
    protected $prefix;

    /**
     * @var ConnectionInterface
     */
    protected $connection;

    function __construct($command, $prefix = "", $params = array(), $connection = null)
    {
        $this->command = $command;
        $this->connection = $connection;
        $this->params = $params;
        $this->prefix = $prefix;
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param ConnectionInterface $connection
     * @return void
     */
    public function setConnection(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function getRaw()
    {
        $command = strtoupper($this->getCommand());

        if ($prefix = $this->getPrefix()) {
            $raw = ":{$prefix} {$command}";
        } else {
            $raw = $this->getCommand();
        }

        if ($params = $this->getParams()) {
            $last = array_pop($params);

            $param_string = implode(' ', $params);
            if ($param_string) {
                $raw .= " {$param_string}";
            }
            $raw .= " :{$last}";
        }

        return $raw;
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return void
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

}
