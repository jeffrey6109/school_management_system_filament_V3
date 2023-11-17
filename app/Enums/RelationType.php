<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RelationType: string implements HasLabel
{
    case Father = 'Father';
    case Mother = 'Mother';
    case Sister = 'Sister';
    case Brother = 'Brother';
    case Guardian = 'Guardian';

    public static function getValues(): array
    {
        return array_column(RelationType::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
