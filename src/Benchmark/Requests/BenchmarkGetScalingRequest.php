<?php

namespace NewDemo\Benchmark\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class BenchmarkGetScalingRequest extends JsonSerializableType
{
    /**
     * @var array<?string> $model
     */
    public array $model;

    /**
     * @param array{
     *   model: array<?string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->model = $values['model'];
    }
}
