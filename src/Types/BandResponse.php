<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class BandResponse extends JsonSerializableType
{
    /**
     * @var float $alpha Quantile significance level for the band, which represents the share of data points expected to lie beyond the band.
     */
    #[JsonProperty('alpha')]
    public float $alpha;

    /**
     * @var ?array<float> $x
     */
    #[JsonProperty('x'), ArrayType(['float'])]
    public ?array $x;

    /**
     * @var ?array<float> $low
     */
    #[JsonProperty('low'), ArrayType(['float'])]
    public ?array $low;

    /**
     * @var ?array<float> $high
     */
    #[JsonProperty('high'), ArrayType(['float'])]
    public ?array $high;

    /**
     * @param array{
     *   alpha: float,
     *   x?: ?array<float>,
     *   low?: ?array<float>,
     *   high?: ?array<float>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->alpha = $values['alpha'];
        $this->x = $values['x'] ?? null;
        $this->low = $values['low'] ?? null;
        $this->high = $values['high'] ?? null;
    }
}
