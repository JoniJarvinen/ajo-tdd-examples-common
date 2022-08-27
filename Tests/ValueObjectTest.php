<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Tests;

use Ajo\Tdd\Examples\Common\Tests\TestValueObjects\OneLevelValueObject;
use Ajo\Tdd\Examples\Common\Tests\TestValueObjects\ThreeLevelValueObject;
use Ajo\Tdd\Examples\Common\Tests\TestValueObjects\TwoLevelValueObject;
use Ajo\Tdd\Examples\Common\ValueObjects\AbstractValueObject;
use DateTime;
use PHPUnit\Framework\TestCase;

class ValueObjectTest extends TestCase
{
    /**
     * @test
     * @dataProvider equalValueObjects
     */
    public function should_be_equal(AbstractValueObject $value1, AbstractValueObject $value2)
    {
        $this->assertTrue($value1->equals($value2), sprintf('Value object %s should have been considered equal to Value object %s', $value1::class, $value2::class));
    }

    /**
     * @test
     * @dataProvider notEqualValueObjects
     */
    public function should_not_be_equal(AbstractValueObject $value1, AbstractValueObject $value2)
    {
        $this->assertTrue(!$value1->equals($value2), sprintf('Value object %s should not have been considered equal to Value object %s', $value1::class, $value2::class));
    }

    private function equalValueObjects(): array
    {
        $testDate = new DateTime('now');
        $oneLevel1 = new OneLevelValueObject('Test', 1.25);
        $oneLevel2 = new OneLevelValueObject('Test', 1.25);
        $nested1 = new TwoLevelValueObject($oneLevel1, $oneLevel2, $testDate);
        $nested2 = new TwoLevelValueObject($oneLevel1, $oneLevel2, $testDate);
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
        $oneLevel1 = new OneLevelValueObject('Test', 6.66);
        $oneLevel2 = new OneLevelValueObject('Test', 6.65);
        $twoLevel1 = new TwoLevelValueObject($oneLevel1, $oneLevel1, new DateTime('now'));
        $twoLevel2 = new TwoLevelValueObject($oneLevel1, $oneLevel1, new DateTime('now'));
        return [
            'One level value object' => [$oneLevel1, $oneLevel2],
            'Nested value object' => [$twoLevel1, $twoLevel2]
        ];
    }
}