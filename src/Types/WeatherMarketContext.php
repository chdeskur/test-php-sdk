<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class WeatherMarketContext extends JsonSerializableType
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
     * @var ?float $totalAmountRaisedAnnualized A simple estimate of total amount of fundraising in the market at the stage in a rolling window
     */
    #[JsonProperty('total_amount_raised_annualized')]
    public ?float $totalAmountRaisedAnnualized;

    /**
     * @var ?float $roundsAnnualized A simple estimate of total count of rounds in the market at the stage in a rolling window
     */
    #[JsonProperty('rounds_annualized')]
    public ?float $roundsAnnualized;

    /**
     * @var ?float $averageRaiseYears The average number of years between raises in the market at the stage in a rolling window
     */
    #[JsonProperty('average_raise_years')]
    public ?float $averageRaiseYears;

    /**
     * @var ?float $averageAmountRaised The average amount raised in the market at the stage in a rolling window
     */
    #[JsonProperty('average_amount_raised')]
    public ?float $averageAmountRaised;

    /**
     * @param array{
     *   stage: string,
     *   date: string,
     *   totalAmountRaisedAnnualized?: ?float,
     *   roundsAnnualized?: ?float,
     *   averageRaiseYears?: ?float,
     *   averageAmountRaised?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->stage = $values['stage'];
        $this->date = $values['date'];
        $this->totalAmountRaisedAnnualized = $values['totalAmountRaisedAnnualized'] ?? null;
        $this->roundsAnnualized = $values['roundsAnnualized'] ?? null;
        $this->averageRaiseYears = $values['averageRaiseYears'] ?? null;
        $this->averageAmountRaised = $values['averageAmountRaised'] ?? null;
    }
}
