<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Religion: string implements HasLabel
{
    case Islam = 'islam';
    case Christian = 'christian';
    case Buddhism = 'buddhism';
    case Hinduism = 'hinduism';
    case Other = 'other';

    public static function getValues(): array
    {
        return array_column(Religion::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
