<?php

namespace NewDemo\Talent;

use NewDemo\Core\Client\RawClient;
use NewDemo\Types\ExecutiveProfile;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\Environments;
use NewDemo\Core\Client\HttpMethod;
use NewDemo\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use NewDemo\Types\EndpointSeniorityCount;
use NewDemo\Types\FunctionLevelGrowthAccounting;

class TalentClient
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
     * Get the profiles of the executives for the company associated with the deal.
     *
     * @param int $groupId
     * @param int $dealId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<ExecutiveProfile>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getExecutiveProfiles(int $groupId, int $dealId, ?array $options = null): array
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/executive-profiles",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [ExecutiveProfile::class]); // @phpstan-ignore-line
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
     * Returns the number of employees at various seniority levels as of the endpoint of the talent data for the deal.
     *
     * @param int $groupId
     * @param int $dealId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<EndpointSeniorityCount>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getSeniorityCount(int $groupId, int $dealId, ?array $options = null): array
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/seniority-count",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [EndpointSeniorityCount::class]); // @phpstan-ignore-line
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
     * The function-level growth accounting for employees within the company. Measure how many users join, churn, or
     * resurrect, at the function level, for each period there is data.
     *
     * @param int $groupId
     * @param int $dealId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<FunctionLevelGrowthAccounting>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getTeamGrowthAccounting(int $groupId, int $dealId, ?array $options = null): array
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/team-growth-accounting",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [FunctionLevelGrowthAccounting::class]); // @phpstan-ignore-line
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
