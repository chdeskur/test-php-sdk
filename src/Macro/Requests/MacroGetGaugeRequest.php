<?php

namespace NewDemo\Macro\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class MacroGetGaugeRequest extends JsonSerializableType
{
    /**
     * @var array<?string> $slug
     */
    public array $slug;

    /**
     * @param array{
     *   slug: array<?string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->slug = $values['slug'];
    }
}
