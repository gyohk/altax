<?php
namespace Test\Altax\Module\Task\Resource;

use Altax\Foundation\Container;
use Altax\Foundation\ModuleFacade;
use Altax\Module\Task\TaskModule;
use Altax\Module\Task\Resource\DefinedTask;
use Altax\Module\Task\Resource\RuntimeTask;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class RuntimeTaskTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->container = new Container();
        $this->definedTask = DefinedTask::newInstance("test", $this->container);
        $this->input = new ArrayInput(array("command" => "test"));
        $this->output = new BufferedOutput();
        
    }

    public function testConstruct()
    {
        $runtimeTask = new RuntimeTask($this->definedTask, $this->input, $this->output);
        $this->assertEquals("Altax\Module\Task\Resource\RuntimeTask", get_class($runtimeTask));
    }

    public function testSetAndGetInput()
    {
        $runtimeTask = new RuntimeTask($this->definedTask, $this->input, $this->output);

        $this->assertSame($this->input, $runtimeTask->getInput());
        $input = new ArrayInput(array("command" => "test2"));
        $runtimeTask->setInput($input);
        $this->assertSame($input, $runtimeTask->getInput());
        $this->assertNotSame($this->input, $runtimeTask->getInput());
    }

    public function testSetAndGetOutput()
    {
        $runtimeTask = new RuntimeTask($this->definedTask, $this->input, $this->output);

        $this->assertSame($this->output, $runtimeTask->getOutput());
        $output = new BufferedOutput();
        $runtimeTask->setOutput($output);
        $this->assertSame($output, $runtimeTask->getOutput());
        $this->assertNotSame($this->output, $runtimeTask->getOutput());
    }

    public function testGetConfig()
    {
        $runtimeTask = new RuntimeTask($this->definedTask, $this->input, $this->output);

        $this->assertSame($this->definedTask->getConfig(), $runtimeTask->getConfig());
    }
}