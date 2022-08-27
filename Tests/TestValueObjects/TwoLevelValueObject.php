<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Tests\TestValueObjects;

use Ajo\Tdd\Examples\Common\ValueObjects\AbstractValueObject;
use DateTime;

class TwoLevelValueObject extends AbstractValueObject
{
    public function __construct(
        private OneLevelValueObject $oneLevel,
        private OneLevelValueObject $oneLevel2,
        public readonly DateTime $dateTime,
        public ?string $publicValue = 'Publics are not equated'
    ) {
    }
}
