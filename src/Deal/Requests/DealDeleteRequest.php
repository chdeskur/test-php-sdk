<?php

namespace NewDemo\Deal\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class DealDeleteRequest extends JsonSerializableType
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
