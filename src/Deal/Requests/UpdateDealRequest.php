<?php

namespace NewDemo\Deal\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Types\Status;
use NewDemo\Types\Priority;
use NewDemo\Core\Types\ArrayType;

class UpdateDealRequest extends JsonSerializableType
{
    /**
     * @var ?string $name
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?string $roundName
     */
    #[JsonProperty('round_name')]
    public ?string $roundName;

    /**
     * @var ?value-of<Status> $status
     */
    #[JsonProperty('status')]
    public ?string $status;

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
     * @var ?int $companyId
     */
    #[JsonProperty('company_id')]
    public ?int $companyId;

    /**
     * @param array{
     *   name?: ?string,
     *   roundName?: ?string,
     *   status?: ?value-of<Status>,
     *   notes?: ?string,
     *   priority?: ?value-of<Priority>,
     *   roundAmount?: ?int,
     *   roundTarget?: ?int,
     *   tags?: ?array<string>,
     *   companyId?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->roundName = $values['roundName'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->notes = $values['notes'] ?? null;
        $this->priority = $values['priority'] ?? null;
        $this->roundAmount = $values['roundAmount'] ?? null;
        $this->roundTarget = $values['roundTarget'] ?? null;
        $this->tags = $values['tags'] ?? null;
        $this->companyId = $values['companyId'] ?? null;
    }
}
