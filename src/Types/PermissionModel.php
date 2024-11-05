<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class PermissionModel extends JsonSerializableType
{
    /**
     * @var string $resource The resource the permission is for
     */
    #[JsonProperty('resource')]
    public string $resource;

    /**
     * @var string $action The action the permission allows
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @param array{
     *   resource: string,
     *   action: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->resource = $values['resource'];
        $this->action = $values['action'];
    }
}
