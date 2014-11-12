<?php
use Buttress\IRC\Action\ActionManager;
use Buttress\IRC\Action\ConnectionAction;
use Buttress\IRC\Connection\Connection;
use Buttress\IRC\Logger\CLILogger;
use Buttress\IRC\Message\MessageFactory;

require './vendor/autoload.php';

$factory = new MessageFactory();
$manager = new ActionManager($factory);
$connection = new Connection($manager, 'irc.freenode.org');

$logger = new CLILogger(true);
$connection->setLogger($logger);

$connection_action = new ConnectionAction('Buttress', '#irctest');
$manager->add('CONNECT', $connection_action);

$connection->connect();
