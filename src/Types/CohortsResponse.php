<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

/**
 * The basic cohort metrics for the user count and amount.
 *
 * The "amount" is a generic term for the metric being measured, such as revenue or gtv.
 */
class CohortsResponse extends JsonSerializableType
{
    /**
     * @var string $cohort The date of the cohort.
     */
    #[JsonProperty('cohort')]
    public string $cohort;

    /**
     * @var int $period The period of the cohort. 0 is the first period.
     */
    #[JsonProperty('period')]
    public int $period;

    /**
     * @var int $cohortSize The number of users in the cohort.
     */
    #[JsonProperty('cohort_size')]
    public int $cohortSize;

    /**
     * @var float $cohortSizeAmount The size denominated in the metric amount of the cohort.
     */
    #[JsonProperty('cohort_size_amount')]
    public float $cohortSizeAmount;

    /**
     * @var int $activeUsers The number of active users in the period.
     */
    #[JsonProperty('active_users')]
    public int $activeUsers;

    /**
     * @var ?float $logoRetention The logo retention rate, defined as active / cohort size.
     */
    #[JsonProperty('logo_retention')]
    public ?float $logoRetention;

    /**
     * @var ?float $amount The active amount, such as revenue or gtv, in the period for the cohort.
     */
    #[JsonProperty('amount')]
    public ?float $amount;

    /**
     * @var ?float $amountRetention The amount retention rate, defined as amount / cohort size amount.
     */
    #[JsonProperty('amount_retention')]
    public ?float $amountRetention;

    /**
     * @var ?float $ltv The cumulative lifetime value in terms of the metric amount up until the period, on average per user in the cohort.
     */
    #[JsonProperty('ltv')]
    public ?float $ltv;

    /**
     * @param array{
     *   cohort: string,
     *   period: int,
     *   cohortSize: int,
     *   cohortSizeAmount: float,
     *   activeUsers: int,
     *   logoRetention?: ?float,
     *   amount?: ?float,
     *   amountRetention?: ?float,
     *   ltv?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->cohort = $values['cohort'];
        $this->period = $values['period'];
        $this->cohortSize = $values['cohortSize'];
        $this->cohortSizeAmount = $values['cohortSizeAmount'];
        $this->activeUsers = $values['activeUsers'];
        $this->logoRetention = $values['logoRetention'] ?? null;
        $this->amount = $values['amount'] ?? null;
        $this->amountRetention = $values['amountRetention'] ?? null;
        $this->ltv = $values['ltv'] ?? null;
    }
}
