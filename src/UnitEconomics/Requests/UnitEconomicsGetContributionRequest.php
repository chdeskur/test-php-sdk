<?php

namespace NewDemo\UnitEconomics\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Types\UserType;
use NewDemo\Types\Frequency;

class UnitEconomicsGetContributionRequest extends JsonSerializableType
{
    /**
     * @var value-of<UserType> $userType
     */
    public string $userType;

    /**
     * @var ?value-of<Frequency> $freq
     */
    public ?string $freq;

    /**
     * @param array{
     *   userType: value-of<UserType>,
     *   freq?: ?value-of<Frequency>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userType = $values['userType'];
        $this->freq = $values['freq'] ?? null;
    }
}
