<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

/**
 * Represents the growth accounting metrics at the function level for a company.
 *
 * This model captures the changes in employee count within specific functions over time.
 */
class FunctionLevelGrowthAccounting extends JsonSerializableType
{
    /**
     * @var string $function The function or department within the company.
     */
    #[JsonProperty('function')]
    public string $function;

    /**
     * @var string $date The date of the entry in YYYYQ format.
     */
    #[JsonProperty('date')]
    public string $date;

    /**
     * @var int $active The number of active employees in the function during the period.
     */
    #[JsonProperty('active')]
    public int $active;

    /**
     * @var int $new The number of new employees in the function during the period.
     */
    #[JsonProperty('new')]
    public int $new;

    /**
     * @var int $retained The number of employees retained in the function from the last period.
     */
    #[JsonProperty('retained')]
    public int $retained;

    /**
     * @var int $resurrected The number of employees who left and returned to the function.
     */
    #[JsonProperty('resurrected')]
    public int $resurrected;

    /**
     * @var int $churned The number of employees who left the function during the period.
     */
    #[JsonProperty('churned')]
    public int $churned;

    /**
     * @param array{
     *   function: string,
     *   date: string,
     *   active: int,
     *   new: int,
     *   retained: int,
     *   resurrected: int,
     *   churned: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->function = $values['function'];
        $this->date = $values['date'];
        $this->active = $values['active'];
        $this->new = $values['new'];
        $this->retained = $values['retained'];
        $this->resurrected = $values['resurrected'];
        $this->churned = $values['churned'];
    }
}
