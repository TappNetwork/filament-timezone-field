<?php

namespace Tapp\FilamentTimezoneField\Concerns;

use DateTime;
use DateTimeZone;

trait CanFormatTimezone
{
    protected function getFormattedOffset(string $offset): string
    {
        $hours = intval($offset / 3600);
        $minutes = abs(intval($offset % 3600 / 60));

        return $this->getTimezoneType().($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
    }

    protected function getFormattedTimezoneName(string $name): string
    {
        return str_replace(
            ['/', '_', 'St '],
            [', ', ' ', 'St. '],
            $name
        );
    }

    protected function getFormattedOffsetAndTimezone(string $offset, string $timezone): string
    {
        return sprintf('(%s) %s', $this->getFormattedOffset($offset), $this->getFormattedTimezoneName($timezone));
    }

    public function getOffset(string $timezone): string
    {
        $now = new DateTime('now', new DateTimeZone($this->getTimezoneType()));

        return $now->setTimezone(new DateTimeZone($timezone))->getOffset();
    }
}
