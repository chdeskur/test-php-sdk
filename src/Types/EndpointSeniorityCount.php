<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

/**
 * The count of employees at each seniority level at the company
 */
class EndpointSeniorityCount extends JsonSerializableType
{
    /**
     * @var string $seniority The seniority level of the employee.
     */
    #[JsonProperty('seniority')]
    public string $seniority;

    /**
     * @var int $count The count of employees at the seniority level.
     */
    #[JsonProperty('count')]
    public int $count;

    /**
     * @param array{
     *   seniority: string,
     *   count: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->seniority = $values['seniority'];
        $this->count = $values['count'];
    }
}
