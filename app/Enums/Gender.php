<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum Gender: string implements HasLabel, HasColor
{
    case Male = 'male';
    case Female = 'female';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Male => 'primary',
            self::Female => 'danger',
        };
    }
}
