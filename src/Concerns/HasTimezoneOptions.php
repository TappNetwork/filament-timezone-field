<?php

namespace Tapp\FilamentTimezoneField\Concerns;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Arr;
use Tapp\FilamentTimezoneField\Enums\Region;

trait HasTimezoneOptions
{
    protected array|string|Closure|null $byCountry = null;

    protected array|Region|int|Closure|null $byRegion = null;

    public function getOptions(): array
    {
        $options = $this->getTimezones();

        $this->options = $options;

        return $this->options;
    }

    public function getTimezones(): array
    {
        $timezones = match (true) {
            ! empty($this->byCountry) => $this->listTimezonesByCountry($this->byCountry),
            ! empty($this->byRegion) => $this->listTimezonesByRegion($this->byRegion),
            default => $this->listAllTimezones(),
        };

        $data = [];

        $now = new DateTime('now', new DateTimeZone($this->getTimezoneType()));

        foreach ($timezones as $timezone) {
            $offsets[] = $offset = $now->setTimezone(new DateTimeZone($timezone))->getOffset();

            if ($this->getDisplayOffset() && $this->getDisplayNames()) {
                $data[$timezone] = $this->getFormattedOffsetAndTimezone($offset, $timezone);
            } elseif ($this->getDisplayOffset()) {
                $data[$timezone] = $this->getFormattedOffset($offset);
            } else {
                $data[$timezone] = $this->getFormattedTimezoneName($timezone);
            }
        }

        array_multisort($offsets, $data);

        return $data;
    }

    public function byCountry(array|string|Closure|null $countryCode): static
    {
        $this->byCountry = $countryCode;

        return $this;
    }

    public function getByCountry(): array|string|null
    {
        return $this->evaluate($this->byCountry);
    }

    public function byRegion(array|Region|int|Closure|null $region): static
    {
        $this->byRegion = $region;

        return $this;
    }

    public function getByRegion(): array|Region|int|null
    {
        return $this->evaluate($this->byRegion);
    }

    protected function listTimezonesByCountry(array|string $countryCodes)
    {
        $countryCodes = Arr::wrap($countryCodes);

        $timezones = [];

        foreach ($countryCodes as $countryCode) {
            $timezones = array_merge($timezones, DateTimeZone::listIdentifiers(
                timezoneGroup: DateTimeZone::PER_COUNTRY,
                countryCode: $countryCode,
            ));
        }

        return $timezones;
    }

    protected function listTimezonesByRegion(array|Region|int $regions)
    {
        $regions = Arr::wrap($regions);

        $timezones = [];

        foreach ($regions as $region) {
            $timezones = array_merge($timezones, DateTimeZone::listIdentifiers(
                timezoneGroup: $region?->value ?? $region,
            ));
        }

        return $timezones;
    }

    protected function listAllTimezones()
    {
        return DateTimeZone::listIdentifiers(DateTimeZone::ALL);
    }
}
