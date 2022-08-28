<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Domain\Workflow;

use ArrayObject;
use TypeError;

class PlaceCollection extends ArrayObject
{
    public function __construct(Place ...$places)
    {
        parent::__construct(...$places);
    }
    public function offsetSet(mixed $key, mixed $value): void
    {
        if(
            $value === null ||
            !$value instanceof Place
        ) {
            throw new TypeError(
                sprintf('Expected type "%s"', Place::class)
            );
        }
        parent::offsetSet($key, $value);
    }
    public function offsetGet(mixed $key): Place
    {
        return parent::offsetGet($key);
    }
}
