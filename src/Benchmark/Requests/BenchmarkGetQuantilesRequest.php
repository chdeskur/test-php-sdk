<?php

namespace NewDemo\Benchmark\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class BenchmarkGetQuantilesRequest extends JsonSerializableType
{
    /**
     * @var float $revenue Annualized revenue scale for which to obtain benchmarks
     */
    public float $revenue;

    /**
     * @var array<?string> $column
     */
    public array $column;

    /**
     * @param array{
     *   revenue: float,
     *   column: array<?string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->revenue = $values['revenue'];
        $this->column = $values['column'];
    }
}
