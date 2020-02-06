<?php

declare(strict_types=1);

namespace Test\Spatie;

use App\SpatieEnum\PaymentResult;
use PHPUnit\Framework\TestCase;

class PaymentResultTest extends TestCase
{
    /**
     * @test
     */
    public function enum_test(): void
    {
        $approved = PaymentResult::approved();
        $this->assertSame('approved', $approved->getValue());
    }
}