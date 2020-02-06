<?php

declare(strict_types=1);

namespace App\MyClabs;

use MyCLabs\Enum\Enum;

/**
* @method static self APPROVED()
* @method static self DECLINED()
* @method static self ERROR()
*/
class PaymentResult extends Enum
{
    private const APPROVED = 'approved';
    private const DECLINED = 'declined';
    private const ERROR = 'error';
}