<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class ProductInfoResponse extends JsonSerializableType
{
    /**
     * @var string $userType
     */
    #[JsonProperty('user_type')]
    public string $userType;

    /**
     * @var string $metric
     */
    #[JsonProperty('metric')]
    public string $metric;

    /**
     * @param array{
     *   userType: string,
     *   metric: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userType = $values['userType'];
        $this->metric = $values['metric'];
    }
}
