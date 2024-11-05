<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class PaginatedResponseFileResponse extends JsonSerializableType
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
     * @var array<FileResponse> $data
     */
    #[JsonProperty('data'), ArrayType([FileResponse::class])]
    public array $data;

    /**
     * @param array{
     *   totalCount: int,
     *   page: int,
     *   pageSize: int,
     *   data: array<FileResponse>,
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
