<?php

namespace NewDemo\File\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class FileReadUrlRequest extends JsonSerializableType
{
    /**
     * @var ?string $contentType
     */
    public ?string $contentType;

    /**
     * @var ?bool $download
     */
    public ?bool $download;

    /**
     * @param array{
     *   contentType?: ?string,
     *   download?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->contentType = $values['contentType'] ?? null;
        $this->download = $values['download'] ?? null;
    }
}
