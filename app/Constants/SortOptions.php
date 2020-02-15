<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class SortOptions extends Enum
{
    use Concerns\HasEnumValues;

    public const ASC = 'asc';
    public const DESC = 'desc';
}
