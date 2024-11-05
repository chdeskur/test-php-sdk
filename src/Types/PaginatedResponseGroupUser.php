<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class PaginatedResponseGroupUser extends JsonSerializableType
{
    /**
     * @var int $totalCount
     */
    #[JsonProperty('total_count')]
    public int $totalCount;

    /**
     * @var int $page
     */
    #[JsonProperty('page')]
    public int $page;

    /**
     * @var int $pageSize
     */
    #[JsonProperty('page_size')]
    public int $pageSize;

    /**
     * @var array<GroupUser> $data
     */
    #[JsonProperty('data'), ArrayType([GroupUser::class])]
    public array $data;

    /**
     * @param array{
     *   totalCount: int,
     *   page: int,
     *   pageSize: int,
     *   data: array<GroupUser>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->totalCount = $values['totalCount'];
        $this->page = $values['page'];
        $this->pageSize = $values['pageSize'];
        $this->data = $values['data'];
    }
}
