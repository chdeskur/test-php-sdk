<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class UnitEconomicsInfoResponse extends JsonSerializableType
{
    /**
     * @var string $userType
     */
    #[JsonProperty('user_type')]
    public string $userType;

    /**
     * @param array{
     *   userType: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userType = $values['userType'];
    }
}
