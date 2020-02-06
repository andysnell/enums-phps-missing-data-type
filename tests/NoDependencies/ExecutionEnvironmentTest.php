<?php

namespace Test\NoDependencies;

use App\NoDependencies\ExecutionEnvironment;
use PHPUnit\Framework\TestCase;

class ExecutionEnvironmentTest extends TestCase
{
    /**
     * @test
     */
    public function the_value_does_not_need_to_be_exposed(): void
    {
        $enum = ExecutionEnvironment::HTTP();

        $this->assertInstanceOf(ExecutionEnvironment::class, $enum);
        $this->assertEquals(ExecutionEnvironment::HTTP(), $enum);
        $this->assertEquals(ExecutionEnvironment::HTTP(), ExecutionEnvironment::HTTP());
        $this->assertNotEquals(ExecutionEnvironment::HTTP(), ExecutionEnvironment::WORKER());
        $this->assertNotEquals(ExecutionEnvironment::HTTP(), ExecutionEnvironment::CLI());
        $this->assertNotSame(ExecutionEnvironment::HTTP(), $enum);
        $this->assertNotSame(ExecutionEnvironment::HTTP(), ExecutionEnvironment::HTTP());
    }
}
