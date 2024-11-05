<?php

namespace NewDemo\Product\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Types\UserType;
use NewDemo\Types\Frequency;

class ProductGetCohortsRequest extends JsonSerializableType
{
    /**
     * @var value-of<UserType> $userType
     */
    public string $userType;

    /**
     * @var string $metric
     */
    public string $metric;

    /**
     * @var ?value-of<Frequency> $freq
     */
    public ?string $freq;

    /**
     * @param array{
     *   userType: value-of<UserType>,
     *   metric: string,
     *   freq?: ?value-of<Frequency>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userType = $values['userType'];
        $this->metric = $values['metric'];
        $this->freq = $values['freq'] ?? null;
    }
}
