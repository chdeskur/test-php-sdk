<?php

namespace NewDemo\Financials;

use NewDemo\Core\Client\RawClient;
use NewDemo\Types\FinancialsResponse;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\Environments;
use NewDemo\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class FinancialsClient
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
     * Get the financials for the company associated with the deal.
     *
     * @param int $groupId
     * @param int $dealId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return FinancialsResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function get(int $groupId, int $dealId, ?array $options = null): FinancialsResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/data/financials",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return FinancialsResponse::fromJson($json);
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
