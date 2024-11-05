<?php

namespace NewDemo\UnitEconomics;

use NewDemo\Core\Client\RawClient;
use NewDemo\UnitEconomics\Requests\UnitEconomicsGetContributionRequest;
use NewDemo\Types\ContributionResponse;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\Environments;
use NewDemo\Core\Client\HttpMethod;
use NewDemo\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class UnitEconomicsClient
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
     * Get the contribution for the user type.
     *
     * @param int $groupId
     * @param int $dealId
     * @param UnitEconomicsGetContributionRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return array<ContributionResponse>
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function getContribution(int $groupId, int $dealId, UnitEconomicsGetContributionRequest $request, ?array $options = null): array
    {
        $query = [];
        $query['user_type'] = $request->userType;
        if ($request->freq != null) {
            $query['freq'] = $request->freq;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/contribution",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [ContributionResponse::class]); // @phpstan-ignore-line
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
