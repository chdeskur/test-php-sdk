<?php

namespace NewDemo\File\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Types\FileType;

class FileRequest extends JsonSerializableType
{
    /**
     * @var string $name The huamn-readable name of the file
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var ?value-of<FileType> $type The type of the file
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @param array{
     *   name: string,
     *   type?: ?value-of<FileType>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->type = $values['type'] ?? null;
    }
}
