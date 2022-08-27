<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Tests\Domain;

use Ajo\Tdd\Examples\Common\Domain\Email;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /**
     * @test
     * @dataProvider validEmails
     */
    public function should_accept_valid_email(string $validEmail): void
    {
        $email = new Email($validEmail);
        $this->assertInstanceOf(Email::class, $email, sprintf('Failed to instantiate "%s" with a valid e-mail of: "%s"', Email::class, $validEmail));
    }

    /**
     * @test
     * @dataProvider invalidEmails
     */
    public function should_throw_invalid_argument_exception_on_invalid_email(string $invalidEmail): void
    {
        $this->expectException(InvalidArgumentException::class);
        $email = new Email($invalidEmail);
    }
    private function validEmails(): array
    {
        return [
            'a@a.com' => ['a@a.com'],
            '0ds@00.asd.com' => ['0ds@00.asd.com']
        ];
    }

    private function invalidEmails(): array
    {
        return [
            'sad@' => ['sad@'],
            'asffdsa@ffff' => ['asffdsa@ffff'],
            '@dfsdf.com' => ['@dfsdf.com']
        ];
    }
}