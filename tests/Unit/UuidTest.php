<?php

namespace Ufo\DoctrineHelper\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Ufo\DoctrineHelper\Utils\Uuid;

/**
 * Test class for the Uuid class.
 *
 * This class focuses on testing the hash method,
 * which generates a UUID based on a name and a specific namespace.
 */
class UuidTest extends TestCase
{
    /**
     * Test if the hash method generates a valid UUID.
     */
    public function testHashGeneratesValidUuid(): void
    {
        $name = 'test-name';
        $uuid = Uuid::hash($name);
        $this->assertTrue(RamseyUuid::isValid($uuid), 'Generated hash must be a valid UUID.');
    }

    /**
     * Test if the hash method generates consistent UUIDs for the same name.
     */
    public function testHashIsConsistent(): void
    {
        $name = 'consistent-name';
        $uuid1 = Uuid::hash($name);
        $uuid2 = Uuid::hash($name);
        $this->assertSame($uuid1, $uuid2, 'UUIDs generated with the same name must be the same.');
    }

    /**
     * Test if the hash method generates different UUIDs for different names.
     */
    public function testHashDiffersForDifferentNames(): void
    {
        $name1 = 'name1';
        $name2 = 'name2';
        $uuid1 = Uuid::hash($name1);
        $uuid2 = Uuid::hash($name2);
        $this->assertNotSame($uuid1, $uuid2, 'UUIDs generated with different names must be different.');
    }

}