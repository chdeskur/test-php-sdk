<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class FinancialsResponse extends JsonSerializableType
{
    /**
     * @var ?value-of<Frequency> $freq The frequency of the financial data.
     */
    #[JsonProperty('freq')]
    public ?string $freq;

    /**
     * @var ?array<IncomeStatementEntry> $incomeStatement The entries in the income statement.
     */
    #[JsonProperty('income_statement'), ArrayType([IncomeStatementEntry::class])]
    public ?array $incomeStatement;

    /**
     * @var ?array<CategoryGrowthRates> $categoryGrowthRates The growth rates for each category. The c{x}gr values will occur where x matches the frequency.
     */
    #[JsonProperty('category_growth_rates'), ArrayType([CategoryGrowthRates::class])]
    public ?array $categoryGrowthRates;

    /**
     * @var ?array<FinancialMetrics> $financialMetrics Derived financial metrics for the company.
     */
    #[JsonProperty('financial_metrics'), ArrayType([FinancialMetrics::class])]
    public ?array $financialMetrics;

    /**
     * @param array{
     *   freq?: ?value-of<Frequency>,
     *   incomeStatement?: ?array<IncomeStatementEntry>,
     *   categoryGrowthRates?: ?array<CategoryGrowthRates>,
     *   financialMetrics?: ?array<FinancialMetrics>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->freq = $values['freq'] ?? null;
        $this->incomeStatement = $values['incomeStatement'] ?? null;
        $this->categoryGrowthRates = $values['categoryGrowthRates'] ?? null;
        $this->financialMetrics = $values['financialMetrics'] ?? null;
    }
}
