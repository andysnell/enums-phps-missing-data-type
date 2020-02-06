<?php

namespace Test\NoDependencies;

use App\NoDependencies\PaymentResult;
use PHPUnit\Framework\TestCase;

class PaymentResultTest extends TestCase
{
    /**
     * @test
     */
    public function foo():void
    {
        $enum = PaymentResult::APPROVED();

        $this->assertSame('approved', $enum->getValue());
        $this->assertInstanceOf(PaymentResult::class, $enum);
        $this->assertNotEquals(PaymentResult::APPROVED(), PaymentResult::DECLINED());
        $this->assertNotSame(PaymentResult::APPROVED(), $enum);
        $this->assertEquals(PaymentResult::APPROVED(), PaymentResult::APPROVED());
        $this->assertNotSame(PaymentResult::APPROVED(), PaymentResult::APPROVED());
    }
}
