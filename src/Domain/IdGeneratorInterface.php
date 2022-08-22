<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Domain;

interface IdGeneratorInterface
{
    public function nextIdentity() : string;
}