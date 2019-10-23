<?php

declare(strict_types=1);

namespace App;

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
final class AccountStatus extends Enum
{
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

    protected static $cache = [];

    protected static $transitions = [
        'accepted' => ['APPROVED', 'DECLINED'],
        'approved' => ['ACTIVATING'],
        'declined' => [],
        'activating' => ['ACTIVATING_FAILED', 'ACTIVE'],
        'activating_failed' => ['ACTIVATING', 'DECLINED'],
        'active' => ['DEACTIVATING'],
        'deactivating' => ['ACTIVE', 'DEACTIVATED'],
        'deactivated' => ['ACTIVATING'],
    ];

    /**
     * @return AccountStatus[]
     */
    public function getTransitions(): array
    {
        return array_map([__CLASS__, 'getInstance'], self::$transitions[$this->value]);
    }

    public function canTransitionTo(AccountStatus $account_status): bool
    {
        return in_array($account_status, $this->getTransitions());
    }
}