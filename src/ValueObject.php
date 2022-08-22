<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common;

abstract class ValueObject implements Equatable
{
    abstract public function equals(Equatable $value): bool;
}