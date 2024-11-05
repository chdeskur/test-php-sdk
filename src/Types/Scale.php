<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class Scale extends JsonSerializableType
{
    /**
     * @var string $metric The metric whose scale is used to subset the benchmark data.
     */
    #[JsonProperty('metric')]
    public string $metric;

    /**
     * @var float $low Low end of the scale.
     */
    #[JsonProperty('low')]
    public float $low;

    /**
     * @var float $high High end of the scale.
     */
    #[JsonProperty('high')]
    public float $high;

    /**
     * @param array{
     *   metric: string,
     *   low: float,
     *   high: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->metric = $values['metric'];
        $this->low = $values['low'];
        $this->high = $values['high'];
    }
}
