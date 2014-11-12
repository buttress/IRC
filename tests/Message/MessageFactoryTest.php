<?php
use Buttress\IRC\Message\MessageFactory;

class MessageFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testRegister()
    {
        $factory = new MessageFactory();
        $id = uniqid();

        $factory->register(
            'TEST',
            function () use ($id) {
                return $id;
            });

        $this->assertEquals($id, $factory->make('TEST'));
    }

    public function testDeconstructRaw()
    {
        $raw = ":prefix TEST param1 param2 :some long param";
        $deconstructed = array(
            'prefix',
            'TEST',
            array('param1', 'param2', 'some long param'));

        $factory = new MessageFactory();
        $this->assertEquals($deconstructed, $factory->deconstructRaw($raw));
    }

}
