<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class CategoriesMetadataResponse extends JsonSerializableType
{
    /**
     * @var array<CategoryMetadata> $major A list of major benchmark categories.
     */
    #[JsonProperty('major'), ArrayType([CategoryMetadata::class])]
    public array $major;

    /**
     * @var array<CategoryMetadata> $minor A list of minor benchmark categories.
     */
    #[JsonProperty('minor'), ArrayType([CategoryMetadata::class])]
    public array $minor;

    /**
     * @param array{
     *   major: array<CategoryMetadata>,
     *   minor: array<CategoryMetadata>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->major = $values['major'];
        $this->minor = $values['minor'];
    }
}
