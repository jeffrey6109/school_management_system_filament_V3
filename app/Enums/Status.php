<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasColor, HasLabel
{
    case Active = 'AS';
    case Active_on_Leave = 'AL';
    case Cancelled_by_Admitting_Office = 'IC';
    case Dropped_by_Division = 'ID';
    case Deferred_Admission = 'IF';
    case Inactive_Graduated = 'IG';
    case Inactive_No_Show = 'IN';
    case Inactive = 'IS';
    case Inactive_Withdrew = 'IW';

    public static function getValues(): array
    {
        return array_column(Status::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Active => 'success',
            self::Active_on_Leave => 'success',
            self::Cancelled_by_Admitting_Office => 'danger',
            self::Dropped_by_Division => 'danger',
            self::Deferred_Admission => 'warning',
            self::Inactive_Graduated => 'success',
            self::Inactive_No_Show => 'danger',
            self::Inactive => 'danger',
            self::Inactive_Withdrew => 'danger',
        };
    }
}
