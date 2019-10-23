<?php

declare(strict_types=1);

namespace Test;

use App\AccountStatus;
use PHPUnit\Framework\TestCase;

class AccountStatusTest extends TestCase
{
    /**
     * @test
     */
    public function getTransitions_will_return_instances_of_AccountStatus(): void
    {
        $status = AccountStatus::ACTIVATING();
        $transitions = $status->getTransitions();
        $this->assertCount(2, $transitions);
        $this->assertContains(AccountStatus::ACTIVATING_FAILED(), $transitions);
        $this->assertContains(AccountStatus::ACTIVE(), $transitions);
    }

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
}
