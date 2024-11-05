<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class GcsSignedUrlResponse extends JsonSerializableType
{
    /**
     * @var string $method
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @var string $url
     */
    #[JsonProperty('url')]
    public string $url;

    /**
     * @var ?array<string, mixed> $fields
     */
    #[JsonProperty('fields'), ArrayType(['string' => 'mixed'])]
    public ?array $fields;

    /**
     * @var ?array<string, mixed> $headers
     */
    #[JsonProperty('headers'), ArrayType(['string' => 'mixed'])]
    public ?array $headers;

    /**
     * @param array{
     *   method: string,
     *   url: string,
     *   fields?: ?array<string, mixed>,
     *   headers?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
        $this->url = $values['url'];
        $this->fields = $values['fields'] ?? null;
        $this->headers = $values['headers'] ?? null;
    }
}
