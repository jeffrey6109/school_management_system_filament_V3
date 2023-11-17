<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Race: string implements HasLabel
{
    case Malay = 'malay';
    case Chinese = 'chinese';
    case Indian = 'indian';
    case Bumiputra = 'bumiputra';
    case Other = 'other';

    public static function getValues(): array
    {
        return array_column(Race::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
