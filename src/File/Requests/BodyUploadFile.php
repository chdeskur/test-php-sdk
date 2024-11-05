<?php

namespace NewDemo\File\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Utils\File;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Types\FileType;

class BodyUploadFile extends JsonSerializableType
{
    /**
     * @var File $file
     */
    public File $file;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var value-of<FileType> $filetype
     */
    #[JsonProperty('filetype')]
    public string $filetype;

    /**
     * @param array{
     *   file: File,
     *   name: string,
     *   filetype: value-of<FileType>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->file = $values['file'];
        $this->name = $values['name'];
        $this->filetype = $values['filetype'];
    }
}
