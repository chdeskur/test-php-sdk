<?php

namespace NewDemo\Benchmark;

use NewDemo\Core\Client\RawClient;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\Environments;
use NewDemo\Core\Client\HttpMethod;
use NewDemo\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use NewDemo\Benchmark\Requests\BenchmarkGetQuantilesRequest;
use NewDemo\Types\BenchmarkQuantile;
use NewDemo\Benchmark\Requests\BenchmarkGetScalingRequest;
use NewDemo\Types\ScaleModel;
use NewDemo\Types\AvailableModelsResponse;
use NewDemo\Benchmark\Requests\BenchmarkGetTradeoffAtScaleRequest;
use NewDemo\Types\TradeoffModel;
use NewDemo\Types\UserType;
use NewDemo\Benchmark\Requests\BenchmarkGetCombinedTimeSeriesRequest;
use NewDemo\Types\DealCombinedMetricsResponse;
use NewDemo\Benchmark\Requests\BenchmarkGetTimeSeriesEndpointRequest;
use NewDemo\Benchmark\Requests\BenchmarkGetDealBenchmarkQuantilesRequest;
use NewDemo\Benchmark\Requests\BenchmarkGetDealBenchmarkTradeoffAtScaleRequest;
use NewDemo\Types\ColumnsMetadataResponse;
use NewDemo\Types\ModelsMetadataResponse;
use NewDemo\Types\CategoriesMetadataResponse;

class BenchmarkClient
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
     * Get the list of categories with benchmark models available for the account.
     *
     * @param int $groupId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<string>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getAvailableBenchmarkCategories(int $groupId, ?array $options = null): array
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/data/benchmark/available-benchmark-categories",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, ['string']); // @phpstan-ignore-line
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
     * Get the benchmark quantiles for a given category at a specified revenue scale. If columns are specified, only those columns will be returned.
     *
     * @param int $groupId
     * @param string $category
     * @param BenchmarkGetQuantilesRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<BenchmarkQuantile>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getQuantiles(int $groupId, string $category, BenchmarkGetQuantilesRequest $request, ?array $options = null): array
    {
        $query = [];
        $query['revenue'] = $request->revenue;
        if ($request->column != null) {
            $query['column'] = $request->column;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/data/benchmark/quantiles/$category",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [BenchmarkQuantile::class]); // @phpstan-ignore-line
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
     * Get the scaling models for a given category. Multiple models can be specified.
     *
     * @param int $groupId
     * @param string $category
     * @param BenchmarkGetScalingRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<string, ScaleModel>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getScaling(int $groupId, string $category, BenchmarkGetScalingRequest $request, ?array $options = null): array
    {
        $query = [];
        if ($request->model != null) {
            $query['model'] = $request->model;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/data/benchmark/scaling/$category",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, ['string' => ScaleModel::class]); // @phpstan-ignore-line
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
     * Get the list of available scaling and tradeoff models for the account.
     *
     * @param int $groupId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return AvailableModelsResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getAvailableModels(int $groupId, ?array $options = null): AvailableModelsResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/data/benchmark/available-models",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return AvailableModelsResponse::fromJson($json);
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
     * Get the tradeoff at scale model for a given category.
     *
     * @param int $groupId
     * @param string $category
     * @param BenchmarkGetTradeoffAtScaleRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<string, TradeoffModel>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getTradeoffAtScale(int $groupId, string $category, BenchmarkGetTradeoffAtScaleRequest $request, ?array $options = null): array
    {
        $query = [];
        $query['revenue'] = $request->revenue;
        if ($request->model != null) {
            $query['model'] = $request->model;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/data/benchmark/tradeoff-at-scale/$category",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, ['string' => TradeoffModel::class]); // @phpstan-ignore-line
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
     * Get the categories with benchmark models available for the company associated with the deal.
     *
     * @param int $groupId
     * @param int $dealId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<string>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getAvailableCompanyCategories(int $groupId, int $dealId, ?array $options = null): array
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/benchmark/available-categories",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, ['string']); // @phpstan-ignore-line
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
     * Get the combined time series data for the deal.
     *
     * @param value-of<UserType> $userType
     * @param int $groupId
     * @param int $dealId
     * @param BenchmarkGetCombinedTimeSeriesRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<DealCombinedMetricsResponse>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getCombinedTimeSeries(string $userType, int $groupId, int $dealId, BenchmarkGetCombinedTimeSeriesRequest $request, ?array $options = null): array
    {
        $query = [];
        if ($request->column != null) {
            $query['column'] = $request->column;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/benchmark/combined-time-series/$userType",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [DealCombinedMetricsResponse::class]); // @phpstan-ignore-line
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
     * Get the time series data endpoint for the deal.
     *
     * @param value-of<UserType> $userType
     * @param int $groupId
     * @param int $dealId
     * @param BenchmarkGetTimeSeriesEndpointRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return DealCombinedMetricsResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getTimeSeriesEndpoint(string $userType, int $groupId, int $dealId, BenchmarkGetTimeSeriesEndpointRequest $request, ?array $options = null): DealCombinedMetricsResponse
    {
        $query = [];
        if ($request->column != null) {
            $query['column'] = $request->column;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/benchmark/time-series-endpoint/$userType",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return DealCombinedMetricsResponse::fromJson($json);
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
     * Get the benchmark quantiles for a given category.
     *
     * @param int $groupId
     * @param int $dealId
     * @param string $category
     * @param BenchmarkGetDealBenchmarkQuantilesRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<BenchmarkQuantile>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getDealBenchmarkQuantiles(int $groupId, int $dealId, string $category, BenchmarkGetDealBenchmarkQuantilesRequest $request, ?array $options = null): array
    {
        $query = [];
        if ($request->column != null) {
            $query['column'] = $request->column;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/benchmark/quantiles/$category",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [BenchmarkQuantile::class]); // @phpstan-ignore-line
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
     * Get the tradeoff models for a given category.
     *
     * @param int $groupId
     * @param int $dealId
     * @param string $category
     * @param BenchmarkGetDealBenchmarkTradeoffAtScaleRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<string, TradeoffModel>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getDealBenchmarkTradeoffAtScale(int $groupId, int $dealId, string $category, BenchmarkGetDealBenchmarkTradeoffAtScaleRequest $request, ?array $options = null): array
    {
        $query = [];
        if ($request->model != null) {
            $query['model'] = $request->model;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/benchmark/tradeoff-at-scale/$category",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, ['string' => TradeoffModel::class]); // @phpstan-ignore-line
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
     * Get the columns metadata.
     *
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return ColumnsMetadataResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getColumnsMetadata(?array $options = null): ColumnsMetadataResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/data/benchmark/metadata/columns",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ColumnsMetadataResponse::fromJson($json);
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
     * Get the models metadata.
     *
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<ModelsMetadataResponse>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getModelsMetadata(?array $options = null): array
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/data/benchmark/metadata/models",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [ModelsMetadataResponse::class]); // @phpstan-ignore-line
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
     * Get the categories metadata.
     *
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return CategoriesMetadataResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getCategoriesMetadata(?array $options = null): CategoriesMetadataResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/data/benchmark/metadata/categories",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CategoriesMetadataResponse::fromJson($json);
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
