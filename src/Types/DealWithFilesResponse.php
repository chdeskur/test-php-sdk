<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;
use DateTime;
use NewDemo\Core\Types\Date;

class DealWithFilesResponse extends JsonSerializableType
{
    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $roundName The name of the round
     */
    #[JsonProperty('round_name')]
    public string $roundName;

    /**
     * @var value-of<Status> $status The status of the deal
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var ?string $notes Notes about the deal
     */
    #[JsonProperty('notes')]
    public ?string $notes;

    /**
     * @var ?value-of<Priority> $priority The priority of the deal
     */
    #[JsonProperty('priority')]
    public ?string $priority;

    /**
     * @var ?int $roundAmount The dollar amount to be raised of the round
     */
    #[JsonProperty('round_amount')]
    public ?int $roundAmount;

    /**
     * @var ?int $roundTarget The target post-money dollar amount of the round
     */
    #[JsonProperty('round_target')]
    public ?int $roundTarget;

    /**
     * @var ?array<string> $tags The tags associated with the deal
     */
    #[JsonProperty('tags'), ArrayType(['string'])]
    public ?array $tags;

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
     * @var CompanyResponse $company
     */
    #[JsonProperty('company')]
    public CompanyResponse $company;

    /**
     * @var ?array<FileResponse> $files
     */
    #[JsonProperty('files'), ArrayType([FileResponse::class])]
    public ?array $files;

    /**
     * @var ?DealDataAvailablityResponse $data
     */
    #[JsonProperty('data')]
    public ?DealDataAvailablityResponse $data;

    /**
     * @param array{
     *   name: string,
     *   roundName: string,
     *   status: value-of<Status>,
     *   notes?: ?string,
     *   priority?: ?value-of<Priority>,
     *   roundAmount?: ?int,
     *   roundTarget?: ?int,
     *   tags?: ?array<string>,
     *   id: int,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     *   isArchived?: ?bool,
     *   company: CompanyResponse,
     *   files?: ?array<FileResponse>,
     *   data?: ?DealDataAvailablityResponse,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->roundName = $values['roundName'];
        $this->status = $values['status'];
        $this->notes = $values['notes'] ?? null;
        $this->priority = $values['priority'] ?? null;
        $this->roundAmount = $values['roundAmount'] ?? null;
        $this->roundTarget = $values['roundTarget'] ?? null;
        $this->tags = $values['tags'] ?? null;
        $this->id = $values['id'];
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->isArchived = $values['isArchived'] ?? null;
        $this->company = $values['company'];
        $this->files = $values['files'] ?? null;
        $this->data = $values['data'] ?? null;
    }
}
