<?php

namespace NewDemo\Group\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class GroupGetByDomainRequest extends JsonSerializableType
{
    /**
     * @var string $domain
     */
    public string $domain;

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
     *   domain: string,
     *   sortBy?: ?string,
     *   sortOrder?: ?string,
     *   page?: ?int,
     *   pageSize?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->domain = $values['domain'];
        $this->sortBy = $values['sortBy'] ?? null;
        $this->sortOrder = $values['sortOrder'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->pageSize = $values['pageSize'] ?? null;
    }
}
