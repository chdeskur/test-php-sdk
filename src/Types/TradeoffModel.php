<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class TradeoffModel extends JsonSerializableType
{
    /**
     * @var Scale $scale Describes the revenue range of the data whose points represent the trade off.
     */
    #[JsonProperty('scale')]
    public Scale $scale;

    /**
     * @var array<array<string, float>> $rawData Raw data points used to generate the scaling model. Dictionary of the two metrics, x then y.
     */
    #[JsonProperty('raw_data'), ArrayType([['string' => 'float']])]
    public array $rawData;

    /**
     * @var array<array<string, float>> $discardedRawData Additional raw data points which were not used in the model fit due to oulier status. Dictionary of the two metrics, x then y.
     */
    #[JsonProperty('discarded_raw_data'), ArrayType([['string' => 'float']])]
    public array $discardedRawData;

    /**
     * @var array<Area> $areas Areas representing the range of the scaling model. The x-y coordinates describe a surface containing 1 - alpha share of the data points.
     */
    #[JsonProperty('areas'), ArrayType([Area::class])]
    public array $areas;

    /**
     * @param array{
     *   scale: Scale,
     *   rawData: array<array<string, float>>,
     *   discardedRawData: array<array<string, float>>,
     *   areas: array<Area>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->scale = $values['scale'];
        $this->rawData = $values['rawData'];
        $this->discardedRawData = $values['discardedRawData'];
        $this->areas = $values['areas'];
    }
}
