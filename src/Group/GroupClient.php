<?php

namespace NewDemo\Group;

use NewDemo\Core\Client\RawClient;
use NewDemo\Group\Requests\GroupGetByDomainRequest;
use NewDemo\Types\GroupWithUsersResponse;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\Environments;
use NewDemo\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use NewDemo\Group\Requests\UpdateGroupRequest;
use NewDemo\Group\Requests\GroupListUsersRequest;
use NewDemo\Types\PaginatedResponseGroupUser;
use NewDemo\Group\Requests\GroupSearchUsersRequest;
use NewDemo\Group\Requests\BodyUploadGroupAvatar;
use NewDemo\Types\GroupResponse;
use NewDemo\Core\Multipart\MultipartFormData;
use NewDemo\Core\Multipart\MultipartApiRequest;
use NewDemo\Group\Requests\AddUserRequest;
use NewDemo\Types\UserRoleResponse;
use NewDemo\Group\Requests\UpdateUserRoleRequest;

class GroupClient
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
     * Lookup a group by its domain.
     *
     * @param GroupGetByDomainRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return GroupWithUsersResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getByDomain(GroupGetByDomainRequest $request, ?array $options = null): GroupWithUsersResponse
    {
        $query = [];
        $query['domain'] = $request->domain;
        if ($request->sortBy != null) {
            $query['sort_by'] = $request->sortBy;
        }
        if ($request->sortOrder != null) {
            $query['sort_order'] = $request->sortOrder;
        }
        if ($request->page != null) {
            $query['page'] = $request->page;
        }
        if ($request->pageSize != null) {
            $query['page_size'] = $request->pageSize;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return GroupWithUsersResponse::fromJson($json);
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
     * Get a group by its ID.
     *
     * @param int $groupId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return GroupWithUsersResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function get(int $groupId, ?array $options = null): GroupWithUsersResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return GroupWithUsersResponse::fromJson($json);
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
     * Update a group.
     *
     * @param int $groupId
     * @param UpdateGroupRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return GroupWithUsersResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function update(int $groupId, UpdateGroupRequest $request, ?array $options = null): GroupWithUsersResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId",
                    method: HttpMethod::PUT,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return GroupWithUsersResponse::fromJson($json);
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
     * Get all users in a group.
     *
     * @param int $groupId
     * @param GroupListUsersRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return PaginatedResponseGroupUser
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function listUsers(int $groupId, GroupListUsersRequest $request, ?array $options = null): PaginatedResponseGroupUser
    {
        $query = [];
        if ($request->sortBy != null) {
            $query['sort_by'] = $request->sortBy;
        }
        if ($request->sortOrder != null) {
            $query['sort_order'] = $request->sortOrder;
        }
        if ($request->page != null) {
            $query['page'] = $request->page;
        }
        if ($request->pageSize != null) {
            $query['page_size'] = $request->pageSize;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/user/all",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return PaginatedResponseGroupUser::fromJson($json);
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
     * Get all users in a group.
     *
     * @param int $groupId
     * @param GroupSearchUsersRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return PaginatedResponseGroupUser
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function searchUsers(int $groupId, GroupSearchUsersRequest $request, ?array $options = null): PaginatedResponseGroupUser
    {
        $query = [];
        if ($request->name != null) {
            $query['name'] = $request->name;
        }
        if ($request->email != null) {
            $query['email'] = $request->email;
        }
        if ($request->sortBy != null) {
            $query['sort_by'] = $request->sortBy;
        }
        if ($request->sortOrder != null) {
            $query['sort_order'] = $request->sortOrder;
        }
        if ($request->page != null) {
            $query['page'] = $request->page;
        }
        if ($request->pageSize != null) {
            $query['page_size'] = $request->pageSize;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/user/search",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return PaginatedResponseGroupUser::fromJson($json);
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
     * Upload an avatar for a group.
     *
     * @param int $groupId
     * @param BodyUploadGroupAvatar $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return GroupResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function uploadGroupAvatar(int $groupId, BodyUploadGroupAvatar $request, ?array $options = null): GroupResponse
    {
        $body = new MultipartFormData();
        $body->addPart($request->image->toMultipartFormDataPart('image'));
        try {
            $response = $this->client->sendRequest(
                new MultipartApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/avatar",
                    method: HttpMethod::POST,
                    body: $body,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return GroupResponse::fromJson($json);
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
     * Add a user role to a group.
     *
     * @param int $userId
     * @param int $groupId
     * @param AddUserRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return UserRoleResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function createUserRole(int $userId, int $groupId, AddUserRequest $request, ?array $options = null): UserRoleResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/user/$userId",
                    method: HttpMethod::POST,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return UserRoleResponse::fromJson($json);
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
     * Update the roles of a user in a group.
     *
     * @param int $userId
     * @param int $groupId
     * @param UpdateUserRoleRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return UserRoleResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function updateUserRoles(int $userId, int $groupId, UpdateUserRoleRequest $request, ?array $options = null): UserRoleResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/user/$userId",
                    method: HttpMethod::PUT,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return UserRoleResponse::fromJson($json);
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
     * Remove a user from a group.
     *
     * @param int $userId
     * @param int $groupId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return UserRoleResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function removeUser(int $userId, int $groupId, ?array $options = null): UserRoleResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/user/$userId",
                    method: HttpMethod::DELETE,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return UserRoleResponse::fromJson($json);
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
