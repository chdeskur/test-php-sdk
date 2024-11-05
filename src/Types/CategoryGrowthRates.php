<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class CategoryGrowthRates extends JsonSerializableType
{
    /**
     * @var string $date The date of the entry.
     */
    #[JsonProperty('date')]
    public string $date;

    /**
     * @var string $category The category of the entry.
     */
    #[JsonProperty('category')]
    public string $category;

    /**
     * @var ?float $cmgr3 3-month category growth rate, for monthly frequency.
     */
    #[JsonProperty('cmgr3')]
    public ?float $cmgr3;

    /**
     * @var ?float $cmgr6 6-month category growth rate, for monthly frequency.
     */
    #[JsonProperty('cmgr6')]
    public ?float $cmgr6;

    /**
     * @var ?float $cmgr12 12-month category growth rate, for monthly frequency.
     */
    #[JsonProperty('cmgr12')]
    public ?float $cmgr12;

    /**
     * @var ?float $cqgr1 1-quarter category growth rate, for quarterly frequency.
     */
    #[JsonProperty('cqgr1')]
    public ?float $cqgr1;

    /**
     * @var ?float $cqgr2 2-quarter category growth rate, for quarterly frequency.
     */
    #[JsonProperty('cqgr2')]
    public ?float $cqgr2;

    /**
     * @var ?float $cqgr4 4-quarter category growth rate, for quarterly frequency.
     */
    #[JsonProperty('cqgr4')]
    public ?float $cqgr4;

    /**
     * @var ?float $cagr1 1-year category growth rate, for annual frequency.
     */
    #[JsonProperty('cagr1')]
    public ?float $cagr1;

    /**
     * @var ?float $cagr2 2-year category growth rate, for annual frequency.
     */
    #[JsonProperty('cagr2')]
    public ?float $cagr2;

    /**
     * @var ?float $cagr4 4-year category growth rate, for annual frequency.
     */
    #[JsonProperty('cagr4')]
    public ?float $cagr4;

    /**
     * @param array{
     *   date: string,
     *   category: string,
     *   cmgr3?: ?float,
     *   cmgr6?: ?float,
     *   cmgr12?: ?float,
     *   cqgr1?: ?float,
     *   cqgr2?: ?float,
     *   cqgr4?: ?float,
     *   cagr1?: ?float,
     *   cagr2?: ?float,
     *   cagr4?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->date = $values['date'];
        $this->category = $values['category'];
        $this->cmgr3 = $values['cmgr3'] ?? null;
        $this->cmgr6 = $values['cmgr6'] ?? null;
        $this->cmgr12 = $values['cmgr12'] ?? null;
        $this->cqgr1 = $values['cqgr1'] ?? null;
        $this->cqgr2 = $values['cqgr2'] ?? null;
        $this->cqgr4 = $values['cqgr4'] ?? null;
        $this->cagr1 = $values['cagr1'] ?? null;
        $this->cagr2 = $values['cagr2'] ?? null;
        $this->cagr4 = $values['cagr4'] ?? null;
    }
}
