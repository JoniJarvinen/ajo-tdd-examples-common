<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Tests\Infrastructure;

use Ajo\Tdd\Examples\Common\Infrastructure\Time\DateTime;
use DateInterval;
use PHPUnit\Framework\TestCase;

class DateTimeTest extends TestCase
{
    /**
     * @test
     * @dataProvider dateMutationMethods
     */
    public function should_return_extended_instances(DateTime $dateTime): void
    {
        $expectedClass = DateTime::class;
        $this->assertEquals($expectedClass, $dateTime::class, sprintf('Expected %s instance, got: %s', $expectedClass, $dateTime::class));
    }

    /**
     * @test
     */
    public function should_be_equal(): void
    {
        $date1 = new DateTime('2022-01-01 00:00:00.00');
        $date2 = new DateTime('2022-01-01 00:00:00.000');
        $this->assertTrue($date1->equals($date2), sprintf('Expected "%s" to be equal to: "%s"', $date1->toString(), $date2->toString()));
    }

    /**
     * @test
     */
    public function should_not_be_equal(): void
    {
        $date1 = new DateTime('2022-01-01 00:00:00.11');
        $date2 = new DateTime('2022-01-01 00:00:00.00');
        $this->assertTrue(!$date1->equals($date2), sprintf('Expected "%s" not to be equal to: "%s"', $date1->toString(), $date2->toString()));
    }

    private function dateMutationMethods(): array
    {
        $dateTime = DateTime::now('UTC');
        return [
            'Base Class' => [$dateTime],
            'Subtract period' => [$dateTime->subtract(new DateInterval('P1D'))],
            'Add period' => [$dateTime->addDays(5)],
            'Previous monday' => [$dateTime->previous(DateTime::MONDAY)]
        ];
    }
}