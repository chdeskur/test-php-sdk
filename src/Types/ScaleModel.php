<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class ScaleModel extends JsonSerializableType
{
    /**
     * @var array<array<string, float>> $rawData Raw data points used to generate the scaling model. Dictionary of the two metrics, x then y.
     */
    #[JsonProperty('raw_data'), ArrayType([['string' => 'float']])]
    public array $rawData;

    /**
     * @var array<array<string, float>> $pred Predicted center trend line of the scaling model. Dictioary of the two metrics, x then y.
     */
    #[JsonProperty('pred'), ArrayType([['string' => 'float']])]
    public array $pred;

    /**
     * @var array<BandResponse> $bands Bands representing the range of the scaling model.
     */
    #[JsonProperty('bands'), ArrayType([BandResponse::class])]
    public array $bands;

    /**
     * @param array{
     *   rawData: array<array<string, float>>,
     *   pred: array<array<string, float>>,
     *   bands: array<BandResponse>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->rawData = $values['rawData'];
        $this->pred = $values['pred'];
        $this->bands = $values['bands'];
    }
}
