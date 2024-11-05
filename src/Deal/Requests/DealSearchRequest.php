<?php

namespace NewDemo\Deal\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class DealSearchRequest extends JsonSerializableType
{
    /**
     * @var ?string $name
     */
    public ?string $name;

    /**
     * @var ?string $roundName
     */
    public ?string $roundName;

    /**
     * @var ?string $notes
     */
    public ?string $notes;

    /**
     * @var ?string $tags
     */
    public ?string $tags;

    /**
     * @var ?string $companyName
     */
    public ?string $companyName;

    /**
     * @var ?string $companyDomain
     */
    public ?string $companyDomain;

    /**
     * @var ?bool $ignoreArchived
     */
    public ?bool $ignoreArchived;

    /**
     * @var ?string $sortBy
     */
    public ?string $sortBy;

    /**
     * @var ?string $sortOrder
     */
    public ?string $sortOrder;

    /**
     * @var ?int $page
     */
    public ?int $page;

    /**
     * @var ?int $pageSize
     */
    public ?int $pageSize;

    /**
     * @param array{
     *   name?: ?string,
     *   roundName?: ?string,
     *   notes?: ?string,
     *   tags?: ?string,
     *   companyName?: ?string,
     *   companyDomain?: ?string,
     *   ignoreArchived?: ?bool,
     *   sortBy?: ?string,
     *   sortOrder?: ?string,
     *   page?: ?int,
     *   pageSize?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->roundName = $values['roundName'] ?? null;
        $this->notes = $values['notes'] ?? null;
        $this->tags = $values['tags'] ?? null;
        $this->companyName = $values['companyName'] ?? null;
        $this->companyDomain = $values['companyDomain'] ?? null;
        $this->ignoreArchived = $values['ignoreArchived'] ?? null;
        $this->sortBy = $values['sortBy'] ?? null;
        $this->sortOrder = $values['sortOrder'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->pageSize = $values['pageSize'] ?? null;
    }
}
