<?php

namespace Ufo\DoctrineHelper\DBAL;

use BackedEnum;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use UnitEnum;

abstract class AbstractEnumType extends Type
{
    protected string|BackedEnum $enum;

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        $values = array_map(fn($val) => "'{$val->value}'", $this->enum::cases());
        return sprintf("ENUM(%s)", implode(", ", $values));
    }
    public function convertToPHPValue(int|string $value, AbstractPlatform $platform): mixed
    {
        return $value;
    }

    public function convertToDatabaseValue(int|string $value, AbstractPlatform $platform): string|int
    {
        try {
            return $this->enum::from($value)->value;
        } catch (\Throwable) {
            throw new \InvalidArgumentException("Invalid '".$this->getName()."' value.");
        }
    }

    public function getName(): string
    {
        return $this->enum;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): true
    {
        return true;
    }
}
