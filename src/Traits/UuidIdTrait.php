<?php

namespace Ufo\DoctrineHelper\Traits;

use Doctrine\ORM\Mapping as ORM;
use Ufo\DoctrineHelper\Utils\Uuid;
use Doctrine\DBAL\Types\Types;

trait UuidIdTrait
{
    #[ORM\Column(type: Types::STRING, length: 36, unique: true)]
    #[ORM\Id]
    protected string $id;

    protected function generateUniqueId(): void
    {
        $this->id = Uuid::generate();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public static function uniqueIdFromString(string $string): string
    {
        return Uuid::hash($string);
    }
}