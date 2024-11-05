<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class CategoryMetadata extends JsonSerializableType
{
    /**
     * @var string $name The name of the category.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $friendlyName The friendly displayable name of the category.
     */
    #[JsonProperty('friendly_name')]
    public string $friendlyName;

    /**
     * @var ?value-of<CategoryMetadataDefaultUserType> $defaultUserType The default user type for the category.
     */
    #[JsonProperty('default_user_type')]
    public ?string $defaultUserType;

    /**
     * @param array{
     *   name: string,
     *   friendlyName: string,
     *   defaultUserType?: ?value-of<CategoryMetadataDefaultUserType>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->friendlyName = $values['friendlyName'];
        $this->defaultUserType = $values['defaultUserType'] ?? null;
    }
}
