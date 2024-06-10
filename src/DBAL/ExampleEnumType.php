<?php

namespace Ufo\DoctrineHelper\DBAL;

use BackedEnum;
use Ufo\DoctrineHelper\ExampleEnum;

class ExampleEnumType extends AbstractEnumType
{
    protected string|BackedEnum $enum = ExampleEnum::class;
}