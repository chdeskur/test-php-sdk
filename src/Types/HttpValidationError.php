<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class HttpValidationError extends JsonSerializableType
{
    /**
     * @var ?array<ValidationError> $detail
     */
    #[JsonProperty('detail'), ArrayType([ValidationError::class])]
    public ?array $detail;

    /**
     * @param array{
     *   detail?: ?array<ValidationError>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->detail = $values['detail'] ?? null;
    }
}
