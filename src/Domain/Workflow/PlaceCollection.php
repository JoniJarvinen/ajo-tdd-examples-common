<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Domain\Workflow;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

class PlaceCollection implements Countable, IteratorAggregate
{
    private array $places = [];
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->places);
    }
    public function count(): int
    {
        return count($this->places);
    }
}
