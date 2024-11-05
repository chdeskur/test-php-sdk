<?php

namespace NewDemo\File\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class FileDeleteRequest extends JsonSerializableType
{
    /**
     * @var ?bool $archive
     */
    public ?bool $archive;

    /**
     * @param array{
     *   archive?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->archive = $values['archive'] ?? null;
    }
}
