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

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
