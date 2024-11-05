<?php

namespace NewDemo\Group\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class UpdateUserRoleRequest extends JsonSerializableType
{
    /**
     * @var array<int> $roleIds
     */
    #[JsonProperty('role_ids'), ArrayType(['integer'])]
    public array $roleIds;

    /**
     * @param array{
     *   roleIds: array<int>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->roleIds = $values['roleIds'];
    }
}
