<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class WeatherComponents extends JsonSerializableType
{
    /**
     * @var string $stage The stage of the weather gauge
     */
    #[JsonProperty('stage')]
    public string $stage;

    /**
     * @var string $date The date of the data point
     */
    #[JsonProperty('date')]
    public string $date;

    /**
     * @var ?float $weatherGauge The values of the individual components of the weather gauge
     */
    #[JsonProperty('weather_gauge')]
    public ?float $weatherGauge;

    /**
     * @var ?float $actualAnnualized The measured actual annualized fundraising amount for the stage in a rolling window, subset only to companies that have known amounts raised in the prior stage. The value is null for future dates beyond the last valid date of the indicator
     */
    #[JsonProperty('actual_annualized')]
    public ?float $actualAnnualized;

    /**
     * @var ?float $potentialAnnualized The estimated present and past potential annualized fundraising amount for the stage in a rolling window, which measures the amount of fundraising one would expect under normal conditions, based on investment in the prior stage and accounting for exits. The value is null for future dates beyond the last valid date of the indicator
     */
    #[JsonProperty('potential_annualized')]
    public ?float $potentialAnnualized;

    /**
     * @var ?float $potentialAnnualizedForecast The estimated future potential annualized fundraising amount for the stage in a rolling window, which measures the amount of fundraising one would expect under normal conditions, based on investment in the prior stage and accounting for exits. The value is null for past dates and forecasted for future dates
     */
    #[JsonProperty('potential_annualized_forecast')]
    public ?float $potentialAnnualizedForecast;

    /**
     * @param array{
     *   stage: string,
     *   date: string,
     *   weatherGauge?: ?float,
     *   actualAnnualized?: ?float,
     *   potentialAnnualized?: ?float,
     *   potentialAnnualizedForecast?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->stage = $values['stage'];
        $this->date = $values['date'];
        $this->weatherGauge = $values['weatherGauge'] ?? null;
        $this->actualAnnualized = $values['actualAnnualized'] ?? null;
        $this->potentialAnnualized = $values['potentialAnnualized'] ?? null;
        $this->potentialAnnualizedForecast = $values['potentialAnnualizedForecast'] ?? null;
    }
}
