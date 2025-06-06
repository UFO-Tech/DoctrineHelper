<?php

namespace Ufo\DoctrineHelper\Traits;

use Doctrine\ORM\Mapping as ORM;
use Ufo\DoctrineHelper\Utils\Uuid;
use Doctrine\DBAL\Types\Types;

use function uniqid;

trait UniqueIdTrait
{
    #[ORM\Column(type: Types::STRING, length: 13, unique: true)]
    #[ORM\Id]
    protected string $id;

    protected function generateUniqueId(): void
    {
        $this->id = uniqid();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}