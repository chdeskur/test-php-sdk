<?php

namespace NewDemo\Group\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class UpdateGroupRequest extends JsonSerializableType
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
     * @var ?int $accountManagerId
     */
    #[JsonProperty('account_manager_id')]
    public ?int $accountManagerId;

    /**
     * @param array{
     *   name?: ?string,
     *   domain?: ?string,
     *   thumbnailUrl?: ?string,
     *   analysisEmail?: ?string,
     *   dataApiAccess?: ?bool,
     *   accountManagerId?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->domain = $values['domain'] ?? null;
        $this->thumbnailUrl = $values['thumbnailUrl'] ?? null;
        $this->analysisEmail = $values['analysisEmail'] ?? null;
        $this->dataApiAccess = $values['dataApiAccess'] ?? null;
        $this->accountManagerId = $values['accountManagerId'] ?? null;
    }
}
