<?php

namespace Tapp\FilamentTimezoneField\Concerns;

use Closure;
use DateTime;
use DateTimeZone;
use Tapp\FilamentTimezoneField\Enums\Region;

trait HasTimezoneOptions
{
    protected string|Closure|null $byCountry = null;

    protected Region|int|Closure|null $byRegion = null;

    protected string|Closure|null $language = 'en';

    public function language(string|Closure|null $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->evaluate($this->language);
    }

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
        $offsets = [];

        $now = new DateTime('now', new DateTimeZone($this->getTimezoneType()));
        $language = $this->getLanguage();

        foreach ($timezones as $timezone) {
            $offsets[] = $offset = $now->setTimezone(new DateTimeZone($timezone))->getOffset();

            if ($this->getDisplayOffset() && $this->getDisplayNames()) {
                $data[$timezone] = $this->getFormattedOffsetAndTimezone($offset, $timezone, $language);
            } elseif ($this->getDisplayOffset()) {
                $data[$timezone] = $this->getFormattedOffset($offset);
            } else {
                $data[$timezone] = $this->getFormattedTimezoneName($timezone, $language);
            }
        }

        array_multisort($offsets, $data);

        return $data;
    }

    public function byCountry(string|Closure|null $countryCode): static
    {
        $this->byCountry = $countryCode;

        return $this;
    }

    public function getByCountry(): ?string
    {
        return $this->evaluate($this->byCountry);
    }

    public function byRegion(Region|int|Closure|null $region): static
    {
        $this->byRegion = $region;

        return $this;
    }

    public function getByRegion(): Region|int|null
    {
        return $this->evaluate($this->byRegion);
    }

    protected function listTimezonesByCountry($countryCode)
    {
        return DateTimeZone::listIdentifiers(
            timezoneGroup: DateTimeZone::PER_COUNTRY,
            countryCode: $countryCode,
        );
    }

    protected function listTimezonesByRegion($region)
    {
        return DateTimeZone::listIdentifiers(
            timezoneGroup: $region?->value ?? $region,
        );
    }

    protected function listAllTimezones()
    {
        return DateTimeZone::listIdentifiers(DateTimeZone::ALL);
    }
}
