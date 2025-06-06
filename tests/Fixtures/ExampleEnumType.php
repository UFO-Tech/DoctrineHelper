<?php

namespace Ufo\DoctrineHelper\Tests\Fixtures;

use BackedEnum;
use Ufo\DoctrineHelper\DBAL\AbstractEnumType;

class ExampleEnumType extends AbstractEnumType
{
    protected string|BackedEnum $enum = ExampleEnum::class;
}