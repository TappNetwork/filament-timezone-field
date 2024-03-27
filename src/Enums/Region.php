<?php

namespace Tapp\FilamentTimezoneField\Enums;

use DateTimeZone;
use Filament\Support\Contracts\HasLabel;

enum Region: int implements HasLabel
{
    case Africa = DateTimeZone::AFRICA;
    case America = DateTimeZone::AMERICA;
    case Antarctica = DateTimeZone::ANTARCTICA;
    case Arctic = DateTimeZone::ARCTIC;
    case Asia = DateTimeZone::ASIA;
    case Atlantic = DateTimeZone::ATLANTIC;
    case Australia = DateTimeZone::AUSTRALIA;
    case Europe = DateTimeZone::EUROPE;
    case Indian = DateTimeZone::INDIAN;
    case Pacific = DateTimeZone::PACIFIC;

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
