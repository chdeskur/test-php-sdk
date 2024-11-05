<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

/**
 * A list of current executives, at the time the talent was pulled, their roles at the company, and their prior
 * positions
 */
class ExecutiveProfile extends JsonSerializableType
{
    /**
     * @var string $personId The unique LinkedIn profile id for the executive.
     */
    #[JsonProperty('person_id')]
    public string $personId;

    /**
     * @var string $personName The name of the executive.
     */
    #[JsonProperty('person_name')]
    public string $personName;

    /**
     * @var string $profileUrl The URL to the executive's LinkedIn profile.
     */
    #[JsonProperty('profile_url')]
    public string $profileUrl;

    /**
     * @var array<ExecutiveProfilePosition> $positions A list of past and present positions held by the executive.
     */
    #[JsonProperty('positions'), ArrayType([ExecutiveProfilePosition::class])]
    public array $positions;

    /**
     * @param array{
     *   personId: string,
     *   personName: string,
     *   profileUrl: string,
     *   positions: array<ExecutiveProfilePosition>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->personId = $values['personId'];
        $this->personName = $values['personName'];
        $this->profileUrl = $values['profileUrl'];
        $this->positions = $values['positions'];
    }
}
