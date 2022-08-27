<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Tests;

use Ajo\Tdd\Examples\Common\Infrastructure\Time\DateTime;
use Ajo\Tdd\Examples\Common\Tests\TestValueObjects\OneLevelValueObject;
use Ajo\Tdd\Examples\Common\Tests\TestValueObjects\ThreeLevelValueObject;
use Ajo\Tdd\Examples\Common\Tests\TestValueObjects\TwoLevelValueObject;
use Ajo\Tdd\Examples\Common\ValueObjects\AbstractValueObject;
use PHPUnit\Framework\TestCase;

class ValueObjectTest extends TestCase
{
    /**
     * @test
     * @dataProvider equalValueObjects
     */
    public function should_be_equal(AbstractValueObject $valueObject, mixed $compareTo)
    {
        $this->assertTrue($valueObject->equals($compareTo), sprintf('Value object: "%s" should have been considered equal to: "%s"', $valueObject::class, gettype($compareTo)));
    }

    /**
     * @test
     * @dataProvider notEqualValueObjects
     */
    public function should_not_be_equal(AbstractValueObject $valueObject, mixed $compareTo)
    {
        $this->assertTrue(!$valueObject->equals($compareTo), sprintf('Value object %s should not have been considered equal to Value object %s', $valueObject::class, gettype($compareTo)));
    }

    private function equalValueObjects(): array
    {
        $testDate1 = new DateTime('2022-01-01 00:00:01');
        $testDate2 = new DateTime('2022-01-01 00:00:01');

        $oneLevel1 = new OneLevelValueObject('Test', 1.25);
        $oneLevel2 = new OneLevelValueObject('Test', 1.25);

        $nested1 = new TwoLevelValueObject($oneLevel1, $oneLevel2, $testDate1);
        $nested2 = new TwoLevelValueObject($oneLevel1, $oneLevel2, $testDate2);

        $multiNested1 = new ThreeLevelValueObject($nested1, $nested2, 'Test');
        $multiNested2 = new ThreeLevelValueObject($nested1, $nested2, 'Test');

        $multiNested3 = new ThreeLevelValueObject($nested2, $nested2, 'Test');
        $multiNested4 = new ThreeLevelValueObject($nested1, $nested1, 'Test');

        return [
            'One level value object' => [$oneLevel1, $oneLevel2],
            'Nested value object' => [$nested1, $nested2],
            'Multi nested value object' => [$multiNested1, $multiNested2],
            'Multi nested value object from different instances' => [$multiNested3, $multiNested4]
        ];
    }

    private function notEqualValueObjects(): array
    {
        $testDate1 = new DateTime('2022-01-01 00:00:01');
        $testDate2 = new DateTime('2022-01-01 00:00:02');
        $oneLevel1 = new OneLevelValueObject('Test', 6.66);
        $oneLevel2 = new OneLevelValueObject('Test', 6.65);
        $twoLevel1 = new TwoLevelValueObject($oneLevel1, $oneLevel1, $testDate1);
        $twoLevel2 = new TwoLevelValueObject($oneLevel1, $oneLevel1, $testDate2);
        return [
            'One level value object' => [$oneLevel1, $oneLevel2],
            'Nested value object' => [$twoLevel1, $twoLevel2],
            'Scalar value' => [$oneLevel1, 'String'],
            'Null value' => [$oneLevel1, null],
            'Boolean value' => [$oneLevel1, true],
            'Random object' => [$oneLevel1, (object)[]]
        ];
    }
}