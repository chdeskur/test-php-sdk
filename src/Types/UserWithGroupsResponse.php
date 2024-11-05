<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use DateTime;
use NewDemo\Core\Types\Date;
use NewDemo\Core\Types\ArrayType;

class UserWithGroupsResponse extends JsonSerializableType
{
    /**
     * @var string $name
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
     * @var int $id
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var ?DateTime $createdAt
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $updatedAt;

    /**
     * @var ?bool $isArchived
     */
    #[JsonProperty('is_archived')]
    public ?bool $isArchived;

    /**
     * @var ?bool $superUser
     */
    #[JsonProperty('super_user')]
    public ?bool $superUser;

    /**
     * @var ?string $apiKeyFinalCharacters
     */
    #[JsonProperty('api_key_final_characters')]
    public ?string $apiKeyFinalCharacters;

    /**
     * @var ?array<GroupResponse> $groups
     */
    #[JsonProperty('groups'), ArrayType([GroupResponse::class])]
    public ?array $groups;

    /**
     * @param array{
     *   name: string,
     *   email: string,
     *   thumbnail?: ?string,
     *   id: int,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     *   isArchived?: ?bool,
     *   superUser?: ?bool,
     *   apiKeyFinalCharacters?: ?string,
     *   groups?: ?array<GroupResponse>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->email = $values['email'];
        $this->thumbnail = $values['thumbnail'] ?? null;
        $this->id = $values['id'];
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->isArchived = $values['isArchived'] ?? null;
        $this->superUser = $values['superUser'] ?? null;
        $this->apiKeyFinalCharacters = $values['apiKeyFinalCharacters'] ?? null;
        $this->groups = $values['groups'] ?? null;
    }
}
