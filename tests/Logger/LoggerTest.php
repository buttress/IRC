<?php

class LoggerTest extends \PHPUnit_Framework_TestCase
{

    public function testLog()
    {
        $logger = new \Buttress\IRC\Logger\CLILogger();

        ob_start();
        $logger->debug('Shouldn\'t Output');
        $this->assertEmpty(trim(ob_get_contents()));
        ob_end_clean();

        ob_start();
        $logger->notice('Should Output');
        $this->assertNotEmpty(trim(ob_get_contents()));
        ob_end_clean();
    }

    public function testLogDebug()
    {
        $logger = new \Buttress\IRC\Logger\CLILogger(true);

        ob_start();
        $logger->debug('Should Output');
        $this->assertNotEmpty(trim(ob_get_contents()));
        ob_end_clean();
    }

    public function testLogContext()
    {
        $logger = new \Buttress\IRC\Logger\CLILogger(true);

        ob_start();
        $logger->debug('', array('SEARCH'));
        $this->assertContains('SEARCH', ob_get_contents());
        ob_end_clean();
    }

}
