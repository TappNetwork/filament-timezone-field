<?php

namespace Tapp\FilamentTimezoneField\Concerns;

use DateTime;
use DateTimeZone;
use Symfony\Component\Intl\Timezones;

trait CanFormatTimezone
{
    protected function getFormattedOffset(string $offset): string
    {
        $hours = intval($offset / 3600);
        $minutes = abs(intval($offset % 3600 / 60));

        return $this->getTimezoneType().($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
    }

    protected function getFormattedTimezoneName(string|DateTimeZone $name, ?string $language = null): string
    {
        $name = is_string($name) ? $name : $name->getName();

        if ($language) {
            try {
                return Timezones::getName($name, $language);
            } catch (\Exception $e) {
                // Fallback to default formatting if translation fails
                return str_replace(
                    ['/', '_', 'St '],
                    [', ', ' ', 'St. '],
                    $name,
                );
            }
        }

        return str_replace(
            ['/', '_', 'St '],
            [', ', ' ', 'St. '],
            $name,
        );
    }

    protected function getFormattedOffsetAndTimezone(string $offset, string|DateTimeZone $timezone, ?string $language = null): string
    {
        return sprintf('(%s) %s', $this->getFormattedOffset($offset), $this->getFormattedTimezoneName($timezone, $language));
    }

    public function getOffset(string|DateTimeZone $timezone): string
    {
        $now = new DateTime('now', new DateTimeZone($this->getTimezoneType()));
        $timezone = is_string($timezone) ? new DateTimeZone($timezone) : $timezone;

        return $now->setTimezone($timezone)->getOffset();
    }
}
