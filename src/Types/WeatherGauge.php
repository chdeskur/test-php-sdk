<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class WeatherGauge extends JsonSerializableType
{
    /**
     * @var string $date The date of the data point
     */
    #[JsonProperty('date')]
    public string $date;

    /**
     * @var string $label The label of the weather gauge
     */
    #[JsonProperty('label')]
    public string $label;

    /**
     * @var ?float $weatherGauge The value of the combined weather gauge incorporating all stages at the given date
     */
    #[JsonProperty('weather_gauge')]
    public ?float $weatherGauge;

    /**
     * @param array{
     *   date: string,
     *   label: string,
     *   weatherGauge?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->date = $values['date'];
        $this->label = $values['label'];
        $this->weatherGauge = $values['weatherGauge'] ?? null;
    }
}
