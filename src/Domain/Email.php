<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Domain;

use Ajo\Tdd\Examples\Common\ValueObjects\AbstractValueObject;
use InvalidArgumentException;
use Stringable;

class Email extends AbstractValueObject implements Stringable
{
    public function __construct(private string $email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
        {
            throw new InvalidArgumentException('Invalid e-mail address given');
        }
    }
    public function toString(): string
    {
        return (string)$this;
    }
    public function __toString(): string
    {
        return $this->email;
    }
    
}