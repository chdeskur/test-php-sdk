<?php

namespace NewDemo\File\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Types\FileType;
use NewDemo\Core\Json\JsonProperty;

class UpdateFileRequest extends JsonSerializableType
{
    /**
     * @var ?value-of<FileType> $type
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @param array{
     *   type?: ?value-of<FileType>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->type = $values['type'] ?? null;
    }
}
