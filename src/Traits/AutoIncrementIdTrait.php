<?php

namespace Ufo\DoctrineHelper\Traits;

use Doctrine\ORM\Mapping as ORM;

trait AutoIncrementIdTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

}