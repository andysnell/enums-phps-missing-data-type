<?php

declare(strict_types=1);

namespace Test\Transitions;

use App\Transitions\AccountStatus;
use PHPUnit\Framework\TestCase;

class AccountStatusTest extends TestCase
{
    /**
     * @test
     * @testWith    ["ACTIVATING", "ACTIVE", true]
     *              ["ACTIVATING", "ACTIVATING_FAILED", true]
     *              ["ACTIVATING", "DECLINED", false]
     */
    public function canTransitionTo_will_return_correctly($status, $transition, $expected): void
    {
        $status = AccountStatus::$status();
        $transition = AccountStatus::$transition();
        $this->assertSame($expected, $status->canTransitionTo($transition));
    }

    /**
     * @test
     * @testWith    ["ACTIVATING", "ACTIVE"]
     *              ["ACTIVATING", "ACTIVATING_FAILED"]
     */
    public function transition_will_return_the_updated_enum($status, $transition): void
    {
        $status = AccountStatus::$status();
        $transition = AccountStatus::$transition();
        $this->assertEquals($transition, $status->transition($transition));
    }

    /**
     * @test
     */
    public function transition_will_throw_exception_for_invalid_transition(): void
    {
        $status = AccountStatus::ACTIVATING();
        $transition = AccountStatus::DECLINED();

        $this->expectException(\RuntimeException::class);
        $status->transition($transition);
    }

    /**
     * @test
     */
    public function transition_is_typesafe(): void
    {
        $status = AccountStatus::ACTIVATING();
        $transition = MockFiniteStateMachineEnum::ACTIVE();

        $this->expectException(\RuntimeException::class);
        $status->transition($transition);
    }
}
