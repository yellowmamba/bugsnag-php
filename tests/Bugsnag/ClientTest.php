<?php

class ClientTest extends PHPUnit_Framework_TestCase {
    protected $client;

    protected function setUp(){
        // Mock the notify function
        $this->client = $this->getMockBuilder('Bugsnag_Client')
                             ->setMethods(array('notify'))
                             ->setConstructorArgs(array('6015a72ff14038114c3d12623dfb018f'))
                             ->getMock();
    }

    public function testErrorHandler() {
        $this->client->expects($this->once())
                     ->method('notify');

        $this->client->errorHandler(E_WARNING, "Something broke", "somefile.php", 123);
    }

    public function testExceptionHandler() {
        $this->client->expects($this->once())
                     ->method('notify');

        $this->client->exceptionHandler(new Exception("Something broke"));
    }

    public function testManualErrorNotification() {
        $this->client->expects($this->once())
                     ->method('notify');

        $this->client->notifyError("SomeError", "Some message");
    }

    public function testManualExceptionNotification() {
        $this->client->expects($this->once())
                     ->method('notify');

        $this->client->notifyException(new Exception("Something broke"));
    }
}

?>