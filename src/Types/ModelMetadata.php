<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class ModelMetadata extends JsonSerializableType
{
    /**
     * @var string $name The name of the model.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $description A plain-english description of the model and what it represents.
     */
    #[JsonProperty('description')]
    public string $description;

    /**
     * @var array<ColumnMiniMetadata> $columns The columns used in the model.
     */
    #[JsonProperty('columns'), ArrayType([ColumnMiniMetadata::class])]
    public array $columns;

    /**
     * @param array{
     *   name: string,
     *   description: string,
     *   columns: array<ColumnMiniMetadata>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->description = $values['description'];
        $this->columns = $values['columns'];
    }
}
