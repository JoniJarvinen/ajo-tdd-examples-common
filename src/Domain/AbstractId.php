<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Domain;

use Ajo\Tdd\Examples\Common\ValueObjects\AbstractValueObject;
use InvalidArgumentException;
use Stringable;

abstract class AbstractId extends AbstractValueObject implements Stringable
{
    public function __construct(protected readonly string $id)
    {
        if (mb_strlen($id) < 1) {
            throw new InvalidArgumentException('ID cannot be an empty string');
        }
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
