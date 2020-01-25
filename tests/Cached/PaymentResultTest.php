<?php


namespace Test\Cached;


use App\Transitions\AccountStatus;
use App\Cached\PaymentResult;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

class PaymentResultTest extends TestCase
{
    /**
     * @test
     */
    public function enum_is_instance_of_a_type_declarable_class(): void
    {
        $this->assertInstanceOf(PaymentResult::class, PaymentResult::APPROVED());
        $this->assertInstanceOf(PaymentResult::class, PaymentResult::DECLINED());
        $this->assertInstanceOf(PaymentResult::class, PaymentResult::ERROR());
    }

    /**
     * @test
     */
    public function enum_will_throw_exception_if_member_not_defined(): void
    {
        $this->expectException(UnexpectedValueException::class);
        PaymentResult::RETRIED();
    }

    /**
     * @test
     * @testWith    ["value"]
     *              ["foobar"]
     */
    public function enum_is_immutable($property): void
    {
        $result = PaymentResult::APPROVED();
        $this->expectException(\LogicException::class);
        $result->$property = 'declined';
    }

    /**
     * @test
     */
    public function enum_is_cached(): void
    {
        $a = PaymentResult::APPROVED();
        $b = PaymentResult::APPROVED();
        $this->assertSame($a, $b);
    }

    /**
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
     * @test
     */
    public function enum_can_be_created_from_a_value(): void
    {
        $this->assertSame(PaymentResult::make('approved'), PaymentResult::APPROVED());
        $this->assertSame(PaymentResult::make('declined'), PaymentResult::DECLINED());
        $this->assertSame(PaymentResult::make('error'), PaymentResult::ERROR());
    }

    /**
     * @test
     */
    public function enum_can_be_cast_to_string(): void
    {
        $this->assertSame('approved', (string)PaymentResult::APPROVED());
        $this->assertSame('declined', (string)PaymentResult::DECLINED());
        $this->assertSame('error', (string)PaymentResult::ERROR());
    }


    /**
     * @test
     */
    public function enum_will_throw_exception_if_value_not_defined(): void
    {
        $this->expectException(UnexpectedValueException::class);
        PaymentResult::make('foobar');
    }

    /**
     * @test
     */
    public function serialized_enums_are_not_equal(): void
    {
        $result = PaymentResult::APPROVED();
        $serialized = serialize($result);
        $this->assertEquals(PaymentResult::APPROVED(), unserialize($serialized));
        $this->assertNotSame(PaymentResult::APPROVED(), unserialize($serialized));
    }
}
