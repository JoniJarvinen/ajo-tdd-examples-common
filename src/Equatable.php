<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common;

interface Equatable
{
    public function equals(Equatable $value) : bool;
}