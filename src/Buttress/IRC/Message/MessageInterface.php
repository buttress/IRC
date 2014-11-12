<?php
namespace Buttress\IRC\Message;

use Buttress\IRC\Connection\ConnectionInterface;

interface MessageInterface
{

    /**
     * @return array
     */
    public function getParams();

    /**
     * @return string
     */
    public function getCommand();

    /**
     * @param string $prefix
     * @return void
     */
    public function setPrefix($prefix);

    /**
     * @return string
     */
    public function getPrefix();

    /**
     * @param ConnectionInterface $connection
     * @return void
     */
    public function setConnection(ConnectionInterface $connection);

    /**
     * @return ConnectionInterface
     */
    public function getConnection();

    /**
     * @return string
     */
    public function getRaw();

}
