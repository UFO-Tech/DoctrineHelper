# DoctrineHelper
A set of ready-made solutions for Doctrine (traits, interfaces, classes) that allows you to get rid of routine and speeds up development

[Documentations](https://docs.ufo-tech.space/bin/view/docs/DoctrineHelper/?language=en)

## Use php enum for MySQL enum type
### 1. Create your enum for cases for your entity field
```php
<?php
namespace App;

enum MyEnum: string
{
    case CASE_1 = 'My case 1';
    case CASE_2 = 'My case 2';
}
```

### 2. Create DBAL class and extend Ufo\DoctrineHelper\DBAL\AbstractEnumType
```php
<?php
namespace App\DBAL;

use BackedEnum;
use App\MyEnum;

class MyEnumType extends AbstractEnumType
{
    protected string|BackedEnum $enum = MyEnum::class;
}
```

### 3. Register new type in DBAL

```yaml
doctrine:
    dbal:
        types:
            App\MyEnum: 'App\DBAL\MyEnumType'
```

### 4. Use your php enum for set and change value

```php
<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'demo')]
class Demo
{
    #[ORM\Column(type: MyEnum::class, nullable: false)]
    protected string $case;


    public function __construct(MyEnum $case)
    {
        $this->case = $case->value;
    }

    public function changeCase(MyEnum $case): void
    {
        $this->type = $case->value;
    }

    public function getCase(): string
    {
        return $this->case;
    }

}
```