<?php

namespace Tapp\FilamentTimezoneField\Forms\Components;

use DateTimeZone;
use Filament\Forms\Components\Select;

class TimezoneSelect extends Select
{
    protected string $view = 'forms::components.select';

    protected string | null $timezoneType = null;

    protected array $allowedTimezoneTypes = [
        'UTC',
        'GMT',
    ];

    public function getOptions(): array
    {
        $options = $this->getTimezones();

        $this->options = $options;

        return $this->options;
    }

    public function timezoneType(string | null $type): static
    {
        $this->timezoneType = strtoupper($type);

        return $this;
    }

    public function getTimezoneType(): string
    {
        if ($this->timezoneType === null && !in_array($this->timezoneType, $this->allowedTimezoneTypes)) {
            $this->timezoneType = 'UTC';
        }

        return $this->timezoneType;
    }

    public function getTimezones(): array
    {
        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        $data = [];

        $now = new \DateTime('now', new DateTimeZone($this->getTimezoneType()));

        foreach ($timezones as $timezone) {
            $offsets[] = $offset = $now->setTimezone(new DateTimeZone($timezone))->getOffset();
            
            $data[$timezone] = sprintf('(%s) %s', $this->getFormattedOffset($offset), $this->getFormattedTimezoneName($timezone));
        }

        array_multisort($offsets, $data);

        return $data;
    }

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
}
