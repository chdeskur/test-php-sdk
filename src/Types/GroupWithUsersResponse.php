<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use DateTime;
use NewDemo\Core\Types\Date;
use NewDemo\Core\Types\ArrayType;

class GroupWithUsersResponse extends JsonSerializableType
{
    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $domain The domain of the group
     */
    #[JsonProperty('domain')]
    public string $domain;

    /**
     * @var ?string $thumbnailUrl The thumbnail URL of the group
     */
    #[JsonProperty('thumbnail_url')]
    public ?string $thumbnailUrl;

    /**
     * @var ?string $analysisEmail The email address for analysis to be sent to
     */
    #[JsonProperty('analysis_email')]
    public ?string $analysisEmail;

    /**
     * @var ?bool $dataApiAccess Whether the group has access to the data API
     */
    #[JsonProperty('data_api_access')]
    public ?bool $dataApiAccess;

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
     * @var ?AccountManagerResponse $accountManager
     */
    #[JsonProperty('account_manager')]
    public ?AccountManagerResponse $accountManager;

    /**
     * @var ?int $userCount
     */
    #[JsonProperty('user_count')]
    public ?int $userCount;

    /**
     * @var ?int $dealCount
     */
    #[JsonProperty('deal_count')]
    public ?int $dealCount;

    /**
     * @var ?array<GroupUser> $users
     */
    #[JsonProperty('users'), ArrayType([GroupUser::class])]
    public ?array $users;

    /**
     * @param array{
     *   name: string,
     *   domain: string,
     *   thumbnailUrl?: ?string,
     *   analysisEmail?: ?string,
     *   dataApiAccess?: ?bool,
     *   id: int,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     *   isArchived?: ?bool,
     *   accountManager?: ?AccountManagerResponse,
     *   userCount?: ?int,
     *   dealCount?: ?int,
     *   users?: ?array<GroupUser>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->domain = $values['domain'];
        $this->thumbnailUrl = $values['thumbnailUrl'] ?? null;
        $this->analysisEmail = $values['analysisEmail'] ?? null;
        $this->dataApiAccess = $values['dataApiAccess'] ?? null;
        $this->id = $values['id'];
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->isArchived = $values['isArchived'] ?? null;
        $this->accountManager = $values['accountManager'] ?? null;
        $this->userCount = $values['userCount'] ?? null;
        $this->dealCount = $values['dealCount'] ?? null;
        $this->users = $values['users'] ?? null;
    }
}
