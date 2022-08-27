<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Tests\TestValueObjects;

use Ajo\Tdd\Examples\Common\ValueObjects\AbstractValueObject;

class ThreeLevelValueObject extends AbstractValueObject
{
    public function __construct(
        private TwoLevelValueObject $twoLevel1,
        private TwoLevelValueObject $twoLevel2,
        protected string $testString
    ) {
    }
}
