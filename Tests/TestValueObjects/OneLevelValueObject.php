<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Tests\TestValueObjects;

use Ajo\Tdd\Examples\Common\ValueObjects\AbstractValueObject;

class OneLevelValueObject extends AbstractValueObject
{
    public function __construct(
        private string $testString,
        private float $testFloat
    ) {
    }
}
