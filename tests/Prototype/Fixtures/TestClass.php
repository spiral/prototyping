<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Prototype\Tests\Fixtures;

//this is an alias which should be inserted as a dependency type
use Spiral\Prototype\Tests\ClassDefinition\ConflictResolver\Fixtures\Test as FTest;
use Spiral\Prototype\Tests\ClassDefinition\ConflictResolver\Fixtures\SubFolder\Test as TestAlias;

//
use Spiral\Prototype\Tests\ClassDefinition\ConflictResolver\Fixtures\TestAlias as ATest3;
use Spiral\Prototype\Tests\Fixtures\TestApp as Test;
use Spiral\Prototype\Traits\PrototypeTrait;

class TestClass
{
    use PrototypeTrait;

    public function getTest()
    {
        return $this->testClass;
    }

    public function method()
    {
        $test2 = $this->test2;
        $test3 = $this->test3;
        $test = $this->test;
    }
}
