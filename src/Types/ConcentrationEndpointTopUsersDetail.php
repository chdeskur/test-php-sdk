<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class ConcentrationEndpointTopUsersDetail extends JsonSerializableType
{
    /**
     * @var string $userId The user identifier.
     */
    #[JsonProperty('user_id')]
    public string $userId;

    /**
     * @var float $amount The amount for the user.
     */
    #[JsonProperty('amount')]
    public float $amount;

    /**
     * @var float $amountPercent The pdf of the total amount for the user.
     */
    #[JsonProperty('amount_percent')]
    public float $amountPercent;

    /**
     * @param array{
     *   userId: string,
     *   amount: float,
     *   amountPercent: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
        $this->amount = $values['amount'];
        $this->amountPercent = $values['amountPercent'];
    }
}
