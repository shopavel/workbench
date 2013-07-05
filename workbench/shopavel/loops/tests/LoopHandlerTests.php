<?php

include '_start.php';

class LoopHandlerTests extends LoopTestCase {

    public $handler;

    public function setUp()
    {
        parent::setUp();
        $this->handler = new Shopavel\Loops\LoopHandler($this->app, 'testhandler', 'testmodel');
    }

    public function testCanSetQuery()
    {
        $builder = Mockery::mock('Illuminate\Database\Eloquent\Builder');
        $this->handler->setQuery($builder);

        $this->assertEquals($this->handler->getQuery(), $builder);
    }

    public function testCanAddOptionHandler()
    {
        $this->handler->addOptionHandler('test', function() { });

        $options = $this->handler->getOptionHandlers();

        $this->assertArrayHasKey('test', $options);
    }

    public function testAddingMultipleOptionHandlers()
    {
        $this->handler->addOptionHandler('test', function() { });
        $this->handler->addOptionHandler('test', function() { });

        $options = $this->handler->getOptionHandlers();

        $this->assertArrayHasKey('test', $options);
    }

    public function testCanSetOptionValues()
    {

    }

    public function testCanApplyOptionHandlers()
    {

    }

    public function testCanGetLoopCollection()
    {

    }

}