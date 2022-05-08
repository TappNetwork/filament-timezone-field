<?php

namespace Tapp\FilamentTimezoneField\Concerns;

use DateTime;
use DateTimeZone;

trait HasTimezoneOptions
{    
    public function getOptions(): array
    {
        $options = $this->getTimezones();

        $this->options = $options;

        return $this->options;
    }

    public function getTimezones(): array
    {
        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        $data = [];

        $now = new DateTime('now', new DateTimeZone($this->getTimezoneType()));

        foreach ($timezones as $timezone) {
            $offsets[] = $offset = $now->setTimezone(new DateTimeZone($timezone))->getOffset();
            
            $data[$timezone] = $this->getFormattedOffsetAndTimezone($offset, $timezone);
        }

        array_multisort($offsets, $data);

        return $data;
    }
}
