<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class UserRoleResponse extends JsonSerializableType
{
    /**
     * @var UserWithPermissionsResponse $user
     */
    #[JsonProperty('user')]
    public UserWithPermissionsResponse $user;

    /**
     * @var GroupResponse $group
     */
    #[JsonProperty('group')]
    public GroupResponse $group;

    /**
     * @param array{
     *   user: UserWithPermissionsResponse,
     *   group: GroupResponse,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->user = $values['user'];
        $this->group = $values['group'];
    }
}
