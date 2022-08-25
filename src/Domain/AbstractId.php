<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Domain;

use Ajo\Tdd\Examples\Common\Equatable;
use Ajo\Tdd\Examples\Common\ValueObject;
use InvalidArgumentException;

abstract class AbstractId extends ValueObject
{
    public function __construct(protected string $id)
    {
        if (mb_strlen($id) < 1) {
            throw new InvalidArgumentException('ID cannot be an empty string');
        }
    }

    public function equals(Equatable $value): bool
    {
        if(!$value instanceof static)
        {
            return false;
        }
        return $this->id === $value->id;
    }
}