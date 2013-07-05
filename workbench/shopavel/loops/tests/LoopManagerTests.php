<?php

class LoopManagerTests extends LoopTestCase {

    public function testCanGetHandlers()
    {
        $handlers = $this->app['loops.manager']->getHandlers();

        $this->assertEquals('array', gettype($handlers));
        $this->assertEquals([], $handlers);
    }

    public function testCanAddHandler()
    {
        $handler = Mockery::mock('Shopavel\Loops\LoopHandler');
        $handler->shouldReceive('addOptionHandler')->andReturn(null);

        $this->app['loops.manager']->addHandler('test', $handler);

        $handlers = $this->app['loops.manager']->getHandlers();

        $this->assertArrayHasKey('test', $handlers);
    }

    public function testCanGetHandlerByKey()
    {
        $handler = Mockery::mock('Shopavel\Loops\LoopHandler');
        $handler->shouldReceive('addOptionHandler')->andReturn('Test Handler');

        $this->app['loops.manager']->addHandler('test', $handler);

        $get = $this->app['loops.manager']->getHandler('test');

        $this->assertEquals($handler, $get);
    }

    public function testCanCreateModelHandler()
    {
        $this->app['loops.manager']->create('test', 'ExampleModel');

        $this->assertArrayHasKey('test', $this->app['loops.manager']->getHandlers());
    }

}