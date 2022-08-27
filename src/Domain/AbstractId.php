<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Domain;

use Ajo\Tdd\Examples\Common\Equatable;
use Ajo\Tdd\Examples\Common\ValueObject;
use InvalidArgumentException;
use Stringable;

abstract class AbstractId extends ValueObject implements Stringable
{
    public function __construct(protected readonly string $id)
    {
        if (mb_strlen($id) < 1) {
            throw new InvalidArgumentException('ID cannot be an empty string');
        }
    }

    public function equals($value): bool
    {
        if (
            $value === null ||
            !$value instanceof static
        ) {
            return false;
        }
        return $this->id === $value->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
