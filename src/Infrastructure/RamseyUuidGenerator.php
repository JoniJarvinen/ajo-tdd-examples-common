<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Infrastructure;

use Ajo\Tdd\Examples\Common\Domain\IdGeneratorInterface;
use Ramsey\Uuid\Uuid;

class RamseyUuidGenerator implements IdGeneratorInterface
{

    public function nextIdentity(): string
    {
        return Uuid::uuid4()->toString();
    }
}
