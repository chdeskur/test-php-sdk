<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

/**
 * Contains a list of past and present positions held by an executive at the company
 */
class ExecutiveProfilePosition extends JsonSerializableType
{
    /**
     * @var ?string $companyName The name of the company where a position was or is held.
     */
    #[JsonProperty('company_name')]
    public ?string $companyName;

    /**
     * @var ?bool $isTargetCompany Whether the company is the same as the company associated with the deal.
     */
    #[JsonProperty('is_target_company')]
    public ?bool $isTargetCompany;

    /**
     * @var ?string $title The title of the position held at the company.
     */
    #[JsonProperty('title')]
    public ?string $title;

    /**
     * @var ?string $startDate The start date of the position.
     */
    #[JsonProperty('start_date')]
    public ?string $startDate;

    /**
     * @var ?string $endDate The end date of the position. If the position is current, this field is null.
     */
    #[JsonProperty('end_date')]
    public ?string $endDate;

    /**
     * @param array{
     *   companyName?: ?string,
     *   isTargetCompany?: ?bool,
     *   title?: ?string,
     *   startDate?: ?string,
     *   endDate?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->companyName = $values['companyName'] ?? null;
        $this->isTargetCompany = $values['isTargetCompany'] ?? null;
        $this->title = $values['title'] ?? null;
        $this->startDate = $values['startDate'] ?? null;
        $this->endDate = $values['endDate'] ?? null;
    }
}
