<?php

declare(strict_types=1);

namespace App\NoDependencies;

abstract class PaymentResult
{
    protected string $value;

    public static function APPROVED(): PaymentResult
    {
        return new class extends PaymentResult {
            protected string $value = 'approved';
        };
    }

    public static function DECLINED(): PaymentResult
    {
        return new class extends PaymentResult {
            protected string $value = 'declined';
        };
    }

    public static function ERROR(): PaymentResult
    {
        return new class extends PaymentResult {
            protected string $value = 'error';
        };
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
