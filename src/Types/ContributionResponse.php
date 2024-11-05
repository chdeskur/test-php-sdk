<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

/**
 * Represents the cohortized contribution for the Unit Economics for the specified user type.
 *
 * This approach assumes all acquisition spend was toward the specified user type.
 *
 * This is the core input to deriving certain unit-economic aggregate metrics.
 */
class ContributionResponse extends JsonSerializableType
{
    /**
     * @var string $cohort The date of the cohort.
     */
    #[JsonProperty('cohort')]
    public string $cohort;

    /**
     * @var int $period The period of the cohort. 0 is the first period.
     */
    #[JsonProperty('period')]
    public int $period;

    /**
     * @var int $cohortSize The number of users in the cohort.
     */
    #[JsonProperty('cohort_size')]
    public int $cohortSize;

    /**
     * @var ?float $cac The customer acquisition cost (CAC) for the cohort.
     */
    #[JsonProperty('cac')]
    public ?float $cac;

    /**
     * @var ?float $ltv The revenue lifetime value (LTV) for the cohort.
     */
    #[JsonProperty('ltv')]
    public ?float $ltv;

    /**
     * @var ?float $ltvCac The LTV to CAC ratio for the cohort for the period.
     */
    #[JsonProperty('ltv_cac')]
    public ?float $ltvCac;

    /**
     * @var ?float $gmltv The gross-margin lifetime value, which is the cumululative gross profit, for the cohort for the period.
     */
    #[JsonProperty('gmltv')]
    public ?float $gmltv;

    /**
     * @var ?float $gmltvCac The gmLTV to CAC ratio for the cohort for the period. This related to the contribution margin.
     */
    #[JsonProperty('gmltv_cac')]
    public ?float $gmltvCac;

    /**
     * @var ?float $contribution The contribution (gmLTV - CAC) for the cohort for the period.
     */
    #[JsonProperty('contribution')]
    public ?float $contribution;

    /**
     * @param array{
     *   cohort: string,
     *   period: int,
     *   cohortSize: int,
     *   cac?: ?float,
     *   ltv?: ?float,
     *   ltvCac?: ?float,
     *   gmltv?: ?float,
     *   gmltvCac?: ?float,
     *   contribution?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->cohort = $values['cohort'];
        $this->period = $values['period'];
        $this->cohortSize = $values['cohortSize'];
        $this->cac = $values['cac'] ?? null;
        $this->ltv = $values['ltv'] ?? null;
        $this->ltvCac = $values['ltvCac'] ?? null;
        $this->gmltv = $values['gmltv'] ?? null;
        $this->gmltvCac = $values['gmltvCac'] ?? null;
        $this->contribution = $values['contribution'] ?? null;
    }
}
