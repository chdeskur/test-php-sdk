<?php

namespace NewDemo\Benchmark\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class BenchmarkGetTradeoffAtScaleRequest extends JsonSerializableType
{
    /**
     * @var float $revenue Annualized revenue scale for which to obtain benchmarks
     */
    public float $revenue;

    /**
     * @var array<?string> $model
     */
    public array $model;

    /**
     * @param array{
     *   revenue: float,
     *   model: array<?string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->revenue = $values['revenue'];
        $this->model = $values['model'];
    }
}
