<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use DateTime;
use NewDemo\Core\Types\Date;
use NewDemo\Core\Types\ArrayType;

class GroupUser extends JsonSerializableType
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
     * @var array<RoleResponse> $roles
     */
    #[JsonProperty('roles'), ArrayType([RoleResponse::class])]
    public array $roles;

    /**
     * @param array{
     *   name: string,
     *   email: string,
     *   thumbnail?: ?string,
     *   id: int,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     *   isArchived?: ?bool,
     *   roles: array<RoleResponse>,
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
        $this->roles = $values['roles'];
    }
}
