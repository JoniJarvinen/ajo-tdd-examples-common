<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Infrastructure\Time;

use Ajo\Tdd\Examples\Common\Equatable;
use Carbon\Carbon;

class DateTime extends Carbon implements Equatable
{
    public function equals(mixed $that): bool
    {
        if (
            $that === null ||
            !$that instanceof DateTime
        ) {
            return false;
        }
        return $this->equalTo($that);
    }
}
