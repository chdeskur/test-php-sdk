<?php

namespace NewDemo\User\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class AuthenticateApiKeyRequest extends JsonSerializableType
{
    /**
     * @var string $apiKey
     */
    #[JsonProperty('api_key')]
    public string $apiKey;

    /**
     * @param array{
     *   apiKey: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->apiKey = $values['apiKey'];
    }
}
