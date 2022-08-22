<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Tests;

use Ajo\Tdd\Examples\Common\Domain\IdGeneratorInterface;
use Ajo\Tdd\Examples\Common\Infrastructure\UuidGenerator;
use PHPUnit\Framework\TestCase;

class IdGeneratorTest extends TestCase
{
    /**
     * @test
     * @dataProvider idGeneratorImplementations
     */
    public function should_generate_valid_uuid_v4(IdGeneratorInterface $idGenerator)
    {
        for ($i = 0; $i < 10; $i++) {
            $nextId = $idGenerator->nextIdentity();
            $this->assertTrue(
                mb_ereg_match('^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$', $nextId),
                sprintf("'%s' should be a valid UUIDv4", $nextId)
            );
        }
    }

    private function idGeneratorImplementations()
    {
        return [
            'UUID Generator' => [new UuidGenerator()] 
        ];
    }
}
