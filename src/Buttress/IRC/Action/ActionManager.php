<?php
namespace Buttress\IRC\Action;

use Buttress\IRC\Connection\ConnectionInterface;
use Buttress\IRC\Message\MessageFactory;

class ActionManager implements ActionManagerInterface
{

    /**
     * @var MessageFactory
     */
    protected $factory;

    /**
     * @var array
     */
    protected $actions = array(
        "*" => array()
    );

    public function __construct(
        MessageFactory $factory,
        ActionInterface $ping_action = null,
        ActionInterface $error_action = null
    ) {
        $this->factory = $factory;

        $this->add('ping', $ping_action ?: new PingAction());
        $this->add('error', $error_action ?: new ErrorAction());
    }

    public function add($command, ActionInterface $action)
    {
        $this->actions[strtoupper($command)][] = $action;
    }

    public function handleConnect(ConnectionInterface $connection)
    {
        foreach ($this->actions as $action_group) {
            /** @var ActionInterface $action */
            foreach ($action_group as $action) {
                $action->handleConnect($connection);
            }
        }
    }

    public function handleRaw(ConnectionInterface $connection, $string)
    {
        $message = $this->factory->getMessageFromRaw($string);
        $message->setConnection($connection);

        foreach ($this->getActions($message->getCommand()) as $action) {
            $action->handleMessage($message);
        }

        foreach ($this->getActions('*') as $action) {
            $action->handleMessage($message);
        }
    }

    /**
     * @param $command
     * @return ActionInterface[]
     */
    protected function getActions($command)
    {
        return isset($this->actions[$command]) ? $this->actions[$command] : array();
    }

}
