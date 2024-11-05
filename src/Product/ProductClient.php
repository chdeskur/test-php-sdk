<?php

namespace NewDemo\Product;

use NewDemo\Core\Client\RawClient;
use NewDemo\Product\Requests\ProductGetUserAccountingRequest;
use NewDemo\Types\UserAccountingResponse;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\Environments;
use NewDemo\Core\Client\HttpMethod;
use NewDemo\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use NewDemo\Product\Requests\ProductGetGrowthAccountingRequest;
use NewDemo\Types\GrowthAccountingResponse;
use NewDemo\Product\Requests\ProductGetCohortsRequest;
use NewDemo\Types\CohortsResponse;
use NewDemo\Product\Requests\ProductGetConcentrationRequest;
use NewDemo\Types\ConcentrationResponse;

class ProductClient
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
     * Get the product user accounting for the company associated with the deal.
     *
     * @param int $groupId
     * @param int $dealId
     * @param ProductGetUserAccountingRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<UserAccountingResponse>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getUserAccounting(int $groupId, int $dealId, ProductGetUserAccountingRequest $request, ?array $options = null): array
    {
        $query = [];
        $query['user_type'] = $request->userType;
        $query['metric'] = $request->metric;
        if ($request->freq != null) {
            $query['freq'] = $request->freq;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/user-accounting",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [UserAccountingResponse::class]); // @phpstan-ignore-line
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
     * Get the product growth accounting for the company associated with the deal.
     *
     * @param int $groupId
     * @param int $dealId
     * @param ProductGetGrowthAccountingRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<GrowthAccountingResponse>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getGrowthAccounting(int $groupId, int $dealId, ProductGetGrowthAccountingRequest $request, ?array $options = null): array
    {
        $query = [];
        $query['user_type'] = $request->userType;
        $query['metric'] = $request->metric;
        if ($request->freq != null) {
            $query['freq'] = $request->freq;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/growth-accounting",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [GrowthAccountingResponse::class]); // @phpstan-ignore-line
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
     * Get the product cohorts for the company associated with the deal.
     *
     * @param int $groupId
     * @param int $dealId
     * @param ProductGetCohortsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<CohortsResponse>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getCohorts(int $groupId, int $dealId, ProductGetCohortsRequest $request, ?array $options = null): array
    {
        $query = [];
        $query['user_type'] = $request->userType;
        $query['metric'] = $request->metric;
        if ($request->freq != null) {
            $query['freq'] = $request->freq;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/cohorts",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [CohortsResponse::class]); // @phpstan-ignore-line
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
     * Get the product concentration for the company associated with the deal.
     *
     * @param int $groupId
     * @param int $dealId
     * @param ProductGetConcentrationRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return ConcentrationResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getConcentration(int $groupId, int $dealId, ProductGetConcentrationRequest $request, ?array $options = null): ConcentrationResponse
    {
        $query = [];
        $query['user_type'] = $request->userType;
        $query['metric'] = $request->metric;
        if ($request->freq != null) {
            $query['freq'] = $request->freq;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/concentration",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ConcentrationResponse::fromJson($json);
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
