<?php

declare(strict_types=1);

namespace Test\Transitions;

use App\Transitions\AccountStatus;
use App\Transitions\FiniteStateMachineEnum;

/**
 * @method static AccountStatus ACTIVE()
 */
final class MockFiniteStateMachineEnum extends FiniteStateMachineEnum
{
    protected static $cache = [];

    protected static $values = [
        'ACTIVE' => 'active',
    ];

    protected static $transitions = [
        'active' => [],
    ];
}