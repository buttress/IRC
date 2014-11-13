[![](http://img.shields.io/badge/license-MIT-green.svg?style=flat)](https://github.com/Buttress/IRC/blob/master/LICENSE)
[![](http://img.shields.io/packagist/v/buttress/irc.svg?style=flat)](https://packagist.org/packages/buttress/irc)
[![](http://img.shields.io/packagist/dt/buttress/irc.svg?style=flat)](https://packagist.org/packages/buttress/irc)
[![](http://img.shields.io/scrutinizer/g/buttress/irc.svg?style=flat)](http://scrutinizer-ci.com/g/Buttress/IRC/)
[![Circle CI](https://circleci.com/gh/Buttress/IRC/tree/master.png?style=badge)](https://circleci.com/gh/Buttress/IRC/tree/master)


#Buttress IRC Client
Connect to IRC servers in record time

```php
<?php
use Buttress\IRC\Action\ActionManager;
use Buttress\IRC\Action\ConnectionAction;
use Buttress\IRC\Connection\Connection;
use Buttress\IRC\Message\MessageFactory;

$factory = new MessageFactory();
$manager = new ActionManager($factory);

$connect_action = new ConnectionAction('Buttress', '#buttress');
$manager->add('CONNECT', $connection_action);

$connection = new \Connection($manager, 'irc.freenode.org');
$connection->connect();
```
