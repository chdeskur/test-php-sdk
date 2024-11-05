<?php

namespace NewDemo\Company;

use NewDemo\Core\Client\RawClient;
use NewDemo\Company\Requests\CompanyGetByDomainRequest;
use NewDemo\Types\CompanyResponse;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\Environments;
use NewDemo\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use NewDemo\Company\Requests\CompanyRequest;
use NewDemo\Company\Requests\CompanyListRequest;
use NewDemo\Types\PaginatedResponseCompanyResponse;
use NewDemo\Company\Requests\UpdateCompanyRequest;
use NewDemo\Company\Requests\CompanyDeleteRequest;
use NewDemo\Core\Json\JsonDecoder;

class CompanyClient
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
     * Lookup a company by domain.
     *
     * @param int $groupId
     * @param CompanyGetByDomainRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return CompanyResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getByDomain(int $groupId, CompanyGetByDomainRequest $request, ?array $options = null): CompanyResponse
    {
        $query = [];
        $query['domain'] = $request->domain;
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/company",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CompanyResponse::fromJson($json);
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
     * Create a new company. If a non-canonical domain is provided, it will be normalized to a canonical form.
     *
     * @param int $groupId
     * @param CompanyRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return CompanyResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function createCompany(int $groupId, CompanyRequest $request, ?array $options = null): CompanyResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/company",
                    method: HttpMethod::POST,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CompanyResponse::fromJson($json);
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
     * Get all companies for a group.
     *
     * @param int $groupId
     * @param CompanyListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return PaginatedResponseCompanyResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function list(int $groupId, CompanyListRequest $request, ?array $options = null): PaginatedResponseCompanyResponse
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
                    path: "api/v1/group/$groupId/company/all",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return PaginatedResponseCompanyResponse::fromJson($json);
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
     * Get a company by ID.
     *
     * @param int $groupId
     * @param int $companyId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return CompanyResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function get(int $groupId, int $companyId, ?array $options = null): CompanyResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/company/$companyId",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CompanyResponse::fromJson($json);
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
     * Update a company.
     *
     * @param int $groupId
     * @param int $companyId
     * @param UpdateCompanyRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return CompanyResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function update(int $groupId, int $companyId, UpdateCompanyRequest $request, ?array $options = null): CompanyResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/company/$companyId",
                    method: HttpMethod::PUT,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CompanyResponse::fromJson($json);
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
     * Delete a company.
     *
     * @param int $companyId
     * @param int $groupId
     * @param CompanyDeleteRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return mixed
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function delete(int $companyId, int $groupId, CompanyDeleteRequest $request, ?array $options = null): mixed
    {
        $query = [];
        if ($request->archive != null) {
            $query['archive'] = $request->archive;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/company/$companyId",
                    method: HttpMethod::DELETE,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeMixed($json);
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
