<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class ColumnsMetadataResponse extends JsonSerializableType
{
    /**
     * @var array<ColumnMetadata> $columns A list of column metadata.
     */
    #[JsonProperty('columns'), ArrayType([ColumnMetadata::class])]
    public array $columns;

    /**
     * @var array<string, ColumnMetadata> $nameMap A mapping column names to their metadata for lookup convenience.
     */
    #[JsonProperty('name_map'), ArrayType(['string' => ColumnMetadata::class])]
    public array $nameMap;

    /**
     * @param array{
     *   columns: array<ColumnMetadata>,
     *   nameMap: array<string, ColumnMetadata>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->columns = $values['columns'];
        $this->nameMap = $values['nameMap'];
    }
}
