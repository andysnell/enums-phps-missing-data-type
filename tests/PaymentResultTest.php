<?php

namespace Test;

use App\AccountStatus;
use App\PaymentResult;
use App\ReadOnly;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

class PaymentResultTest extends TestCase
{
    /**
     * Test #1A - Is this something we're going to be able to typehint on?
     * @test
     */
    public function enum_is_instance_of_a_type_declarable_class(): void
    {
        $this->assertInstanceOf(PaymentResult::class, PaymentResult::APPROVED());
        $this->assertInstanceOf(PaymentResult::class, PaymentResult::DECLINED());
        $this->assertInstanceOf(PaymentResult::class, PaymentResult::ERROR());
    }

    /**
     * Test #1B - Check that we only get values defined in our array.
     * @test
     */
    public function enum_will_throw_exception_if_member_not_defined(): void
    {
        $this->expectException(UnexpectedValueException::class);
        PaymentResult::RETRIED();
    }

    /**
     * Test #2 - Immutable
     * @test
     * @testWith    ["value"]
     *              ["foobar"]
     */
    public function enum_is_immutable($property): void
    {
        $result = PaymentResult::APPROVED();
        $this->expectException(ReadOnly::class);
        $result->$property = 'declined';
    }

    /**
     * Test #3 - Cached
     * @test
     */
    public function enum_is_cached(): void
    {
        $a = PaymentResult::APPROVED();
        $b = PaymentResult::APPROVED();
        $this->assertSame($a, $b);
    }

    /**
     * Test #4A - Comparable
     * @test
     */
    public function enum_is_comparable_to_other_members(): void
    {
        $result = PaymentResult::APPROVED();
        $this->assertEquals($result, PaymentResult::APPROVED());
        $this->assertEquals('approved', (string)PaymentResult::APPROVED());
        $this->assertTrue($result->is(PaymentResult::APPROVED()));
        $this->assertTrue($result->is('approved'));
    }

    /**
     * Test #4B - Comparable
     * @test
     */
    public function enum_is_comparable_to_other_enums(): void
    {
        $account_status = AccountStatus::APPROVED();
        $this->assertNotEquals($account_status, PaymentResult::APPROVED());
    }

    /**
     * Test #5A - Castable
     * @test
     */
    public function enum_can_return_underlying_value(): void
    {
        $this->assertSame(PaymentResult::APPROVED()->value(), 'approved');
        $this->assertSame(PaymentResult::DECLINED()->value(), 'declined');
        $this->assertSame(PaymentResult::ERROR()->value(), 'error');
    }

    /**
     * Test #5B - Castable
     * @test
     */
    public function enum_can_be_created_from_a_value(): void
    {
        $this->assertSame(PaymentResult::make('approved'), PaymentResult::APPROVED());
        $this->assertSame(PaymentResult::make('declined'), PaymentResult::DECLINED());
        $this->assertSame(PaymentResult::make('error'), PaymentResult::ERROR());
    }

    /**
     * Test #5A - Castable
     * @test
     */
    public function enum_can_be_cast_to_string(): void
    {
        $this->assertSame('approved', (string)PaymentResult::APPROVED());
        $this->assertSame('declined', (string)PaymentResult::DECLINED());
        $this->assertSame('error', (string)PaymentResult::ERROR());
    }


    /**
     * Test #5D - Castable
     * @test
     */
    public function enum_will_throw_exception_if_value_not_defined(): void
    {
        $this->expectException(UnexpectedValueException::class);
        PaymentResult::make('foobar');
    }

    /**
     * Test #6 - Serializable
     * @test
     */
    public function enum_is_serializable(): void
    {
        $result = PaymentResult::APPROVED();
        $serialized = serialize($result);
        $this->assertEquals(PaymentResult::APPROVED(), unserialize($serialized));
        $this->assertNotSame(PaymentResult::APPROVED(), unserialize($serialized));
    }
}
