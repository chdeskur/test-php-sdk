<?php

namespace NewDemo\Macro;

use NewDemo\Core\Client\RawClient;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\Environments;
use NewDemo\Core\Client\HttpMethod;
use NewDemo\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use NewDemo\Types\WeatherMetadata;
use NewDemo\Macro\Requests\MacroGetGaugeRequest;
use NewDemo\Types\WeatherGauge;
use NewDemo\Types\WeatherComponents;
use NewDemo\Types\WeatherMarketContext;

class MacroClient
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
     * Returns the available segmentations for the weather module.
     *
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<string>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getSegmentations(?array $options = null): array
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/data/weather/segmentations",
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
     * Returns segmentation metadata for each of the classes of segmentations "geo" and "sector".
     *
     * The geography ("geo") segmentation type refers to major geographic segmentations.
     *
     * The "sector" segmentation type refers to major business model categories in the USA geography.
     *
     * The metadata includes parameters used to generate the respective indicators, and the metadata needed to
     * retrieve the series from the API.
     *
     * @param string $segmentation
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<WeatherMetadata>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getMetadata(string $segmentation, ?array $options = null): array
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/data/weather/$segmentation/metadata",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [WeatherMetadata::class]); // @phpstan-ignore-line
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
     * Returns the overall weather indicator, combined across all stages, for the given segmentation slug(s).
     *
     * If no slug is provided, the endpoint will return the gauge for all available segmentations.
     *
     * @param string $segmentation
     * @param MacroGetGaugeRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<WeatherGauge>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getGauge(string $segmentation, MacroGetGaugeRequest $request, ?array $options = null): array
    {
        $query = [];
        if ($request->slug != null) {
            $query['slug'] = $request->slug;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/data/weather/$segmentation/gauges",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [WeatherGauge::class]); // @phpstan-ignore-line
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
     * Returns the individual components of the weather indicator and some of the underlying inputs of those component gauges for the given segmentation slug.
     *
     * @param string $segmentation
     * @param string $slug
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<WeatherComponents>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getComponents(string $segmentation, string $slug, ?array $options = null): array
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/data/weather/$segmentation/$slug/components",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [WeatherComponents::class]); // @phpstan-ignore-line
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
     * Returns simplified contextual metrics about relevant stages and market activity for the given segmentation slug.
     *
     * @param string $segmentation
     * @param string $slug
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<WeatherMarketContext>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getMarketContext(string $segmentation, string $slug, ?array $options = null): array
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/data/weather/$segmentation/$slug/market-context",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [WeatherMarketContext::class]); // @phpstan-ignore-line
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
