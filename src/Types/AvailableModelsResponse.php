<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class AvailableModelsResponse extends JsonSerializableType
{
    /**
     * @var array<string> $scaling Available scaling models that measure how one metric evolves against a geometric scaling parameter like revenue or number of years or effort.
     */
    #[JsonProperty('scaling'), ArrayType(['string'])]
    public array $scaling;

    /**
     * @var array<string> $tradeoffAtScale Available tradeoff models that measure the tradeoff between two metrics at a given revenue scale.
     */
    #[JsonProperty('tradeoff_at_scale'), ArrayType(['string'])]
    public array $tradeoffAtScale;

    /**
     * @param array{
     *   scaling: array<string>,
     *   tradeoffAtScale: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->scaling = $values['scaling'];
        $this->tradeoffAtScale = $values['tradeoffAtScale'];
    }
}
