<?php
namespace Buttress\IRC\Action;

use Buttress\IRC\Connection\ConnectionInterface;
use Buttress\IRC\Message\MessageInterface;

class CallableAction implements ActionInterface
{

    protected $messageCallable;
    protected $connectCallable;
    protected $tickCallable;

    public function __construct(callable $message_callable, callable $connect_callable, callable $tick_callable)
    {
        $this->messageCallable = $message_callable;
        $this->connectCallable = $connect_callable;
        $this->tickCallable = $tick_callable;
    }

    public function handleConnect(ConnectionInterface $connection)
    {
        $callable = $this->connectCallable;
        if ($callable && is_callable($callable)) {
            $callable($connection);
        }
    }

    public function handleMessage(MessageInterface $message)
    {
        $callable = $this->messageCallable;
        if ($callable && is_callable($callable)) {
            $callable($message);
        }
    }

    /**
     * Handle repeated function calls
     * @param ConnectionInterface $connection
     * @return void
     */
    public function handleTick(ConnectionInterface $connection)
    {
        $callable = $this->tickCallable;
        if ($callable && is_callable($callable)) {
            $callable();
        }
    }

}