<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class DealDataAvailablityResponse extends JsonSerializableType
{
    /**
     * @var bool $financialsExist Financials data has been processed for this deal
     */
    #[JsonProperty('financials_exist')]
    public bool $financialsExist;

    /**
     * @var bool $talentExists Talent data has been processed for this deal
     */
    #[JsonProperty('talent_exists')]
    public bool $talentExists;

    /**
     * @var array<ProductInfoResponse> $productMetrics List of which product metrics are available for this deal
     */
    #[JsonProperty('product_metrics'), ArrayType([ProductInfoResponse::class])]
    public array $productMetrics;

    /**
     * @var array<UnitEconomicsInfoResponse> $unitEconomicsMetrics List of which user types with unit economics metrics are available for this deal
     */
    #[JsonProperty('unit_economics_metrics'), ArrayType([UnitEconomicsInfoResponse::class])]
    public array $unitEconomicsMetrics;

    /**
     * @var array<string> $benchmarksUserTypes List of user types with benchmarks available for this deal
     */
    #[JsonProperty('benchmarks_user_types'), ArrayType(['string'])]
    public array $benchmarksUserTypes;

    /**
     * @var array<string> $benchmarkCategories List of categories applied to the company associated with this deal
     */
    #[JsonProperty('benchmark_categories'), ArrayType(['string'])]
    public array $benchmarkCategories;

    /**
     * @param array{
     *   financialsExist: bool,
     *   talentExists: bool,
     *   productMetrics: array<ProductInfoResponse>,
     *   unitEconomicsMetrics: array<UnitEconomicsInfoResponse>,
     *   benchmarksUserTypes: array<string>,
     *   benchmarkCategories: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->financialsExist = $values['financialsExist'];
        $this->talentExists = $values['talentExists'];
        $this->productMetrics = $values['productMetrics'];
        $this->unitEconomicsMetrics = $values['unitEconomicsMetrics'];
        $this->benchmarksUserTypes = $values['benchmarksUserTypes'];
        $this->benchmarkCategories = $values['benchmarkCategories'];
    }
}
