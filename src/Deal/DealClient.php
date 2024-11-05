<?php

namespace NewDemo\Deal;

use NewDemo\Core\Client\RawClient;
use NewDemo\Deal\Requests\DealRequest;
use NewDemo\Types\DealWithFilesResponse;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\Environments;
use NewDemo\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use NewDemo\Deal\Requests\DealListRequest;
use NewDemo\Types\PaginatedResponseDealWithFilesResponse;
use NewDemo\Deal\Requests\DealSearchRequest;
use NewDemo\Deal\Requests\UpdateDealRequest;
use NewDemo\Deal\Requests\DealDeleteRequest;
use NewDemo\Core\Json\JsonDecoder;

class DealClient
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
     * Create a new deal.
     *
     * @param int $groupId
     * @param DealRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return DealWithFilesResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function create(int $groupId, DealRequest $request, ?array $options = null): DealWithFilesResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal",
                    method: HttpMethod::POST,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return DealWithFilesResponse::fromJson($json);
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
     * Get all deals for a group.
     *
     * @param int $groupId
     * @param DealListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return PaginatedResponseDealWithFilesResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function list(int $groupId, DealListRequest $request, ?array $options = null): PaginatedResponseDealWithFilesResponse
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
                    path: "api/v1/group/$groupId/deal/all",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return PaginatedResponseDealWithFilesResponse::fromJson($json);
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
     * Search deals within a group.
     *
     * @param int $groupId
     * @param DealSearchRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return PaginatedResponseDealWithFilesResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function search(int $groupId, DealSearchRequest $request, ?array $options = null): PaginatedResponseDealWithFilesResponse
    {
        $query = [];
        if ($request->name != null) {
            $query['name'] = $request->name;
        }
        if ($request->roundName != null) {
            $query['round_name'] = $request->roundName;
        }
        if ($request->notes != null) {
            $query['notes'] = $request->notes;
        }
        if ($request->tags != null) {
            $query['tags'] = $request->tags;
        }
        if ($request->companyName != null) {
            $query['company_name'] = $request->companyName;
        }
        if ($request->companyDomain != null) {
            $query['company_domain'] = $request->companyDomain;
        }
        if ($request->ignoreArchived != null) {
            $query['ignore_archived'] = $request->ignoreArchived;
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
                    path: "api/v1/group/$groupId/deal/search",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return PaginatedResponseDealWithFilesResponse::fromJson($json);
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
     * Retrieve a deal by its ID.
     *
     * @param int $groupId
     * @param int $dealId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return DealWithFilesResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function get(int $groupId, int $dealId, ?array $options = null): DealWithFilesResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return DealWithFilesResponse::fromJson($json);
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
     * Update a deal.
     *
     * @param int $groupId
     * @param int $dealId
     * @param UpdateDealRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return DealWithFilesResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function update(int $groupId, int $dealId, UpdateDealRequest $request, ?array $options = null): DealWithFilesResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId",
                    method: HttpMethod::PUT,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return DealWithFilesResponse::fromJson($json);
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
     * Delete a deal.
     *
     * @param int $dealId
     * @param int $groupId
     * @param DealDeleteRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<string, string>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function delete(int $dealId, int $groupId, DealDeleteRequest $request, ?array $options = null): array
    {
        $query = [];
        if ($request->archive != null) {
            $query['archive'] = $request->archive;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId",
                    method: HttpMethod::DELETE,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, ['string' => 'string']); // @phpstan-ignore-line
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
