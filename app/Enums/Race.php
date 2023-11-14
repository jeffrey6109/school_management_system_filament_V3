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
    public function getLabel(): ?string
    {
        return $this->name;
    }
}
