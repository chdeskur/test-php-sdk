<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;
use NewDemo\Core\Types\Union;

class ValidationError extends JsonSerializableType
{
    /**
     * @var array<string|int> $loc
     */
    #[JsonProperty('loc'), ArrayType([new Union('string', 'integer')])]
    public array $loc;

    /**
     * @var string $msg
     */
    #[JsonProperty('msg')]
    public string $msg;

    /**
     * @var string $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @param array{
     *   loc: array<string|int>,
     *   msg: string,
     *   type: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->loc = $values['loc'];
        $this->msg = $values['msg'];
        $this->type = $values['type'];
    }
}
