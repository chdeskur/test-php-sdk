<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class AccountManagerResponse extends JsonSerializableType
{
    /**
     * @var string $name The name of the user
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $email The email address of the user
     */
    #[JsonProperty('email')]
    public string $email;

    /**
     * @var ?string $thumbnail The thumbnail URL of the user
     */
    #[JsonProperty('thumbnail')]
    public ?string $thumbnail;

    /**
     * @param array{
     *   name: string,
     *   email: string,
     *   thumbnail?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->email = $values['email'];
        $this->thumbnail = $values['thumbnail'] ?? null;
    }
}
