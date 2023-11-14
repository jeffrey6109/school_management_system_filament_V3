<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Gender: string implements HasColor, HasLabel
{
    case Male = 'male';
    case Female = 'female';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Male => 'primary',
            self::Female => 'danger',
        };
    }
}
