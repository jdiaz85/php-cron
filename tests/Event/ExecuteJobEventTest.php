<?php

namespace App\Tests;

use App\Event\ExecuteJobEvent;
use PHPUnit\Framework\TestCase;

class ExecuteJobEventTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldReturnTheCommand(): void
    {
        $executeJobEvent = new ExecuteJobEvent("");
        $this->assertIsString($executeJobEvent->getCommand());
        $this->assertEquals("", $executeJobEvent->getCommand());
    }
}
