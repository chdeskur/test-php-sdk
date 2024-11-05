<?php

namespace NewDemo\User;

use NewDemo\Core\Client\RawClient;
use NewDemo\User\Requests\AuthenticateApiKeyRequest;
use NewDemo\Types\AuthenticateApiKeyResponse;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\Environments;
use NewDemo\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use NewDemo\Types\UserWithPermissionsResponse;
use NewDemo\User\Requests\BodyUploadUserAvatar;
use NewDemo\Types\UserWithGroupsResponse;
use NewDemo\Core\Multipart\MultipartFormData;
use NewDemo\Core\Multipart\MultipartApiRequest;
use NewDemo\Types\CreateApiKeyResponse;
use NewDemo\Core\Json\JsonDecoder;

class UserClient
{
    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     */
    public function __construct(
        RawClient $client,
    ) {
        $this->client = $client;
    }

    /**
     * Authenticate an API key and return an access token
     *
     * Returns a client JWT for the provided API key, where the JWT contains claims for permissions and access and can be
     * refreshed as part of an OAuth flow.
     *
     * @param AuthenticateApiKeyRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return AuthenticateApiKeyResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getToken(AuthenticateApiKeyRequest $request, ?array $options = null): AuthenticateApiKeyResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/auth/get-token",
                    method: HttpMethod::POST,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return AuthenticateApiKeyResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new NewDemoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new NewDemoException(message: $e->getMessage(), previous: $e);
        }
        throw new NewDemoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get the current user.
     *
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return UserWithPermissionsResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function me(?array $options = null): UserWithPermissionsResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/user/me",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return UserWithPermissionsResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new NewDemoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new NewDemoException(message: $e->getMessage(), previous: $e);
        }
        throw new NewDemoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Upload an avatar for a user.
     *
     * @param BodyUploadUserAvatar $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return UserWithGroupsResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function uploadUserAvatar(BodyUploadUserAvatar $request, ?array $options = null): UserWithGroupsResponse
    {
        $body = new MultipartFormData();
        $body->addPart($request->image->toMultipartFormDataPart('image'));
        try {
            $response = $this->client->sendRequest(
                new MultipartApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/user/me/avatar",
                    method: HttpMethod::POST,
                    body: $body,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return UserWithGroupsResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new NewDemoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new NewDemoException(message: $e->getMessage(), previous: $e);
        }
        throw new NewDemoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Create or replace an API key for the current user.
     *
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return CreateApiKeyResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function createOrReplaceApiKey(?array $options = null): CreateApiKeyResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/user/api-key",
                    method: HttpMethod::PUT,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CreateApiKeyResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new NewDemoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new NewDemoException(message: $e->getMessage(), previous: $e);
        }
        throw new NewDemoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Delete an API key for the current user.
     *
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<string, mixed>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function deleteApiKey(?array $options = null): array
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/user/api-key",
                    method: HttpMethod::DELETE,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
            }
        } catch (JsonException $e) {
            throw new NewDemoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new NewDemoException(message: $e->getMessage(), previous: $e);
        }
        throw new NewDemoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
