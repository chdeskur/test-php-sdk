<?php

namespace NewDemo\Group\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class AddUserRequest extends JsonSerializableType
{
    /**
     * @var ?int $roleId
     */
    #[JsonProperty('role_id')]
    public ?int $roleId;

    /**
     * @var ?string $roleName
     */
    #[JsonProperty('role_name')]
    public ?string $roleName;

    /**
     * @param array{
     *   roleId?: ?int,
     *   roleName?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->roleId = $values['roleId'] ?? null;
        $this->roleName = $values['roleName'] ?? null;
    }
}
