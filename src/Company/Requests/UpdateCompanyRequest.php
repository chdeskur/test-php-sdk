<?php

namespace NewDemo\Company\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class UpdateCompanyRequest extends JsonSerializableType
{
    /**
     * @var ?string $name
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?string $domain
     */
    #[JsonProperty('domain')]
    public ?string $domain;

    /**
     * @var ?string $thumbnail The thumbnail URL of the company
     */
    #[JsonProperty('thumbnail')]
    public ?string $thumbnail;

    /**
     * @param array{
     *   name?: ?string,
     *   domain?: ?string,
     *   thumbnail?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->domain = $values['domain'] ?? null;
        $this->thumbnail = $values['thumbnail'] ?? null;
    }
}
