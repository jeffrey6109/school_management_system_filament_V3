<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;


enum Status: string implements HasLabel, HasColor
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

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string | array | null
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
