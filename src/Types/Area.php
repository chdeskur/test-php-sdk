<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class Area extends JsonSerializableType
{
    /**
     * @var float $alpha Quantile significance level for the area, which represents the share of data points expected to lie beyond the band.
     */
    #[JsonProperty('alpha')]
    public float $alpha;

    /**
     * @var array<float> $x List of x values for the area.
     */
    #[JsonProperty('x'), ArrayType(['float'])]
    public array $x;

    /**
     * @var array<float> $y List of y values for the area.
     */
    #[JsonProperty('y'), ArrayType(['float'])]
    public array $y;

    /**
     * @param array{
     *   alpha: float,
     *   x: array<float>,
     *   y: array<float>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->alpha = $values['alpha'];
        $this->x = $values['x'];
        $this->y = $values['y'];
    }
}
