<?php
namespace Deuteron\Bundle\ProjectBundle\Tests\Unit;

require_once  __DIR__ . '/../../../../../../vendor/autoload.php';

use mageekguy\atoum\test as atoumtest;

class Test extends atoumtest
{
    public function testFoo()
    {
        $test = new \Deuteron\Bundle\ProjectBundle\Test();

        $this->boolean($test->foo())->isTrue();
    }
}