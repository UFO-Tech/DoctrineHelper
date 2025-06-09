<?php

namespace Ufo\DoctrineHelper\Traits;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait AutoIncrementIdTrait
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER, options: ['unsigned' => true])]
    #[ORM\GeneratedValue]
    protected ?int $id = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

}