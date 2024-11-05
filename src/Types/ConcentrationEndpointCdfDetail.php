<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class ConcentrationEndpointCdfDetail extends JsonSerializableType
{
    /**
     * @var string $method The method used. When 'top_user', the value represents the CDF at the exact value of a top user. When 'distribution_quantile', the value represents the CDF at an approximately evenly spaced quantile.
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @var float $amount The amount for the CDF.
     */
    #[JsonProperty('amount')]
    public float $amount;

    /**
     * @var ?float $cdfUsers The cumulative distribution function of the users, sorted smallest to largest. This evenly weights users by count, and represents (1 - top quantile) of the user
     */
    #[JsonProperty('cdf_users')]
    public ?float $cdfUsers;

    /**
     * @var ?float $cdfAmount The cumulative distribution function of the amount, sorted smallest to largest. This tells us what percentage of all amount is held by the bottom x% of users.
     */
    #[JsonProperty('cdf_amount')]
    public ?float $cdfAmount;

    /**
     * @param array{
     *   method: string,
     *   amount: float,
     *   cdfUsers?: ?float,
     *   cdfAmount?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
        $this->amount = $values['amount'];
        $this->cdfUsers = $values['cdfUsers'] ?? null;
        $this->cdfAmount = $values['cdfAmount'] ?? null;
    }
}
