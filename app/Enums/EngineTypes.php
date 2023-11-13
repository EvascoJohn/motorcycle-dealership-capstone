<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum EngineTypes:string implements HasLabel
{
    case STROKE4 = "Four (4) Stroke";
    case STROKE2 = "Two (2) Stroke";
    case OTHERS = "Other(s)";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::STROKE2 => "Two (2) Stroke",
            self::STROKE4 => "Four (4) Stroke",
            self::OTHERS => "Other(s)",
        };
    }

	public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}