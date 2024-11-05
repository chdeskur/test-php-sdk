<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use DateTime;
use NewDemo\Core\Types\Date;

class CompanyResponse extends JsonSerializableType
{
    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $domain The domain of the company
     */
    #[JsonProperty('domain')]
    public string $domain;

    /**
     * @var ?string $thumbnail The thumbnail URL of the company
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
     * @var int $groupId
     */
    #[JsonProperty('group_id')]
    public int $groupId;

    /**
     * @param array{
     *   name: string,
     *   domain: string,
     *   thumbnail?: ?string,
     *   id: int,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     *   isArchived?: ?bool,
     *   groupId: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->domain = $values['domain'];
        $this->thumbnail = $values['thumbnail'] ?? null;
        $this->id = $values['id'];
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->isArchived = $values['isArchived'] ?? null;
        $this->groupId = $values['groupId'];
    }
}
