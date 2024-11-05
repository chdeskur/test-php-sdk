<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class ConcentrationTimeseriesDetail extends JsonSerializableType
{
    /**
     * @var string $date The date of the entry.
     */
    #[JsonProperty('date')]
    public string $date;

    /**
     * @var ?float $top5Count The share of amount in the top 5 users.
     */
    #[JsonProperty('top_5_count')]
    public ?float $top5Count;

    /**
     * @var ?float $top10Count The share of amount in the top 10 users.
     */
    #[JsonProperty('top_10_count')]
    public ?float $top10Count;

    /**
     * @var ?float $top20Count The share of amount in the top 20 users.
     */
    #[JsonProperty('top_20_count')]
    public ?float $top20Count;

    /**
     * @var ?float $top10Percent The share of amount in the top 10% of users.
     */
    #[JsonProperty('top_10_percent')]
    public ?float $top10Percent;

    /**
     * @var ?float $top20Percent The share of amount in the top 20% of users.
     */
    #[JsonProperty('top_20_percent')]
    public ?float $top20Percent;

    /**
     * @var ?float $mean The mean amount in the period.
     */
    #[JsonProperty('mean')]
    public ?float $mean;

    /**
     * @var ?float $p25 The 25th percentile of the amount in the period.
     */
    #[JsonProperty('p25')]
    public ?float $p25;

    /**
     * @var ?float $median The 50th percentile of the amount in the period.
     */
    #[JsonProperty('median')]
    public ?float $median;

    /**
     * @var ?float $p75 The 75th percentile of the amount in the period.
     */
    #[JsonProperty('p75')]
    public ?float $p75;

    /**
     * @var ?float $p90 The 90th percentile of the amount in the period.
     */
    #[JsonProperty('p90')]
    public ?float $p90;

    /**
     * @var ?float $averageToMedian The ratio of the mean to the median amount in the period.
     */
    #[JsonProperty('average_to_median')]
    public ?float $averageToMedian;

    /**
     * @var ?float $giniCoefficient The Gini coefficient of the amount in the period, ranging from 0 to 1.
     */
    #[JsonProperty('gini_coefficient')]
    public ?float $giniCoefficient;

    /**
     * @param array{
     *   date: string,
     *   top5Count?: ?float,
     *   top10Count?: ?float,
     *   top20Count?: ?float,
     *   top10Percent?: ?float,
     *   top20Percent?: ?float,
     *   mean?: ?float,
     *   p25?: ?float,
     *   median?: ?float,
     *   p75?: ?float,
     *   p90?: ?float,
     *   averageToMedian?: ?float,
     *   giniCoefficient?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->date = $values['date'];
        $this->top5Count = $values['top5Count'] ?? null;
        $this->top10Count = $values['top10Count'] ?? null;
        $this->top20Count = $values['top20Count'] ?? null;
        $this->top10Percent = $values['top10Percent'] ?? null;
        $this->top20Percent = $values['top20Percent'] ?? null;
        $this->mean = $values['mean'] ?? null;
        $this->p25 = $values['p25'] ?? null;
        $this->median = $values['median'] ?? null;
        $this->p75 = $values['p75'] ?? null;
        $this->p90 = $values['p90'] ?? null;
        $this->averageToMedian = $values['averageToMedian'] ?? null;
        $this->giniCoefficient = $values['giniCoefficient'] ?? null;
    }
}
