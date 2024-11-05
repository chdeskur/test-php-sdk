<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class WeatherMetadata extends JsonSerializableType
{
    /**
     * @var string $slug Slugified label for the weather indicator
     */
    #[JsonProperty('slug')]
    public string $slug;

    /**
     * @var string $label Label for the weather indicator
     */
    #[JsonProperty('label')]
    public string $label;

    /**
     * @var string $segmentation The segmentation type of the weather indicator
     */
    #[JsonProperty('segmentation')]
    public string $segmentation;

    /**
     * @var string $asofDate The date of the full revision of the input data for the indicator
     */
    #[JsonProperty('asof_date')]
    public string $asofDate;

    /**
     * @var string $indicatorStartDate The earliest date a data point in the indicator is considered valid
     */
    #[JsonProperty('indicator_start_date')]
    public string $indicatorStartDate;

    /**
     * @var ?array<string> $countries
     */
    #[JsonProperty('countries'), ArrayType(['string'])]
    public ?array $countries;

    /**
     * @var ?array<string> $categories A list of categories the indicator covers - If null, the indicator includes all covered categories
     */
    #[JsonProperty('categories'), ArrayType(['string'])]
    public ?array $categories;

    /**
     * @param array{
     *   slug: string,
     *   label: string,
     *   segmentation: string,
     *   asofDate: string,
     *   indicatorStartDate: string,
     *   countries?: ?array<string>,
     *   categories?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->slug = $values['slug'];
        $this->label = $values['label'];
        $this->segmentation = $values['segmentation'];
        $this->asofDate = $values['asofDate'];
        $this->indicatorStartDate = $values['indicatorStartDate'];
        $this->countries = $values['countries'] ?? null;
        $this->categories = $values['categories'] ?? null;
    }
}
