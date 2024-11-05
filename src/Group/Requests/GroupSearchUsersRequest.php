<?php

namespace NewDemo\Group\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class GroupSearchUsersRequest extends JsonSerializableType
{
    /**
     * @var ?string $name
     */
    public ?string $name;

    /**
     * @var ?string $email
     */
    public ?string $email;

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
     *   email?: ?string,
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
        $this->email = $values['email'] ?? null;
        $this->sortBy = $values['sortBy'] ?? null;
        $this->sortOrder = $values['sortOrder'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->pageSize = $values['pageSize'] ?? null;
    }
}
