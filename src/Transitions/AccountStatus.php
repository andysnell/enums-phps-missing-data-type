<?php

declare(strict_types=1);

namespace App\Transitions;

/**
 * @method static AccountStatus ACCEPTED()
 * @method static AccountStatus APPROVED()
 * @method static AccountStatus DECLINED()
 * @method static AccountStatus ACTIVATING()
 * @method static AccountStatus ACTIVATING_FAILED()
 * @method static AccountStatus ACTIVE()
 * @method static AccountStatus DEACTIVATING()
 * @method static AccountStatus DEACTIVATED()
 */
final class AccountStatus extends FiniteStateMachineEnum
{
    protected static $cache = [];

    protected static $values = [
        'ACCEPTED' => 'accepted',
        'APPROVED' => 'approved',
        'DECLINED' => 'declined',
        'ACTIVATING' => 'activating',
        'ACTIVATING_FAILED' => 'activating_failed',
        'ACTIVE' => 'active',
        'DEACTIVATING' => 'deactivating',
        'DEACTIVATED' => 'deactivated',
    ];

    protected static $transitions = [
        'accepted' => ['approved', 'declined'],
        'approved' => ['activating'],
        'declined' => [],
        'activating' => ['activating_failed', 'active'],
        'activating_failed' => ['activating', 'declined'],
        'active' => ['deactivating'],
        'deactivating' => ['active', 'deactivated'],
        'deactivated' => ['activating'],
    ];
}