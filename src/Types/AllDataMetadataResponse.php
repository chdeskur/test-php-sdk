<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class AllDataMetadataResponse extends JsonSerializableType
{
    /**
     * @var int $dataPointCount
     */
    #[JsonProperty('data_point_count')]
    public int $dataPointCount;

    /**
     * @var int $dataPointCountLast30Days
     */
    #[JsonProperty('data_point_count_last_30_days')]
    public int $dataPointCountLast30Days;

    /**
     * @param array{
     *   dataPointCount: int,
     *   dataPointCountLast30Days: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->dataPointCount = $values['dataPointCount'];
        $this->dataPointCountLast30Days = $values['dataPointCountLast30Days'];
    }
}
