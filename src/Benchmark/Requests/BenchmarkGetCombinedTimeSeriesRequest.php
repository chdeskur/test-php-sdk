<?php

namespace NewDemo\Benchmark\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class BenchmarkGetCombinedTimeSeriesRequest extends JsonSerializableType
{
    /**
     * @var array<?string> $column
     */
    public array $column;

    /**
     * @param array{
     *   column: array<?string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->column = $values['column'];
    }
}
