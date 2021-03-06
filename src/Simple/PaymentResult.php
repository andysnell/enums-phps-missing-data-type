<?php

declare(strict_types=1);

namespace App\Simple;

/**
 * @method static PaymentResult APPROVED()
 * @method static PaymentResult DECLINED()
 * @method static PaymentResult ERROR()
 */
final class PaymentResult extends Enum
{
    protected static $values = [
        'APPROVED' => 'approved',
        'DECLINED' => 'declined',
        'ERROR' => 'error',
    ];
}