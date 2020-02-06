<?php

declare(strict_types=1);

namespace App\SpatieEnum;

use Spatie\Enum\Enum;

/**
 * @method static self approved()
 * @method static self declined()
 * @method static self error()
 */
class PaymentResult extends Enum
{

}