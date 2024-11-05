<?php

namespace NewDemo;

use NewDemo\User\UserClient;
use NewDemo\Group\GroupClient;
use NewDemo\Macro\MacroClient;
use NewDemo\Company\CompanyClient;
use NewDemo\Deal\DealClient;
use NewDemo\File\FileClient;
use NewDemo\Financials\FinancialsClient;
use NewDemo\Product\ProductClient;
use NewDemo\Talent\TalentClient;
use NewDemo\UnitEconomics\UnitEconomicsClient;
use NewDemo\Metadata\MetadataClient;
use NewDemo\Benchmark\BenchmarkClient;
use GuzzleHttp\ClientInterface;
use NewDemo\Core\Client\RawClient;
use NewDemo\Types\HealthzResponse;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class NewDemoClient
{
    /**
     * @var UserClient $user
     */
    public UserClient $user;

    /**
     * @var GroupClient $group
     */
    public GroupClient $group;

    /**
     * @var MacroClient $macro
     */
    public MacroClient $macro;

    /**
     * @var CompanyClient $company
     */
    public CompanyClient $company;

    /**
     * @var DealClient $deal
     */
    public DealClient $deal;

    /**
     * @var FileClient $file
     */
    public FileClient $file;

    /**
     * @var FinancialsClient $financials
     */
    public FinancialsClient $financials;

    /**
     * @var ProductClient $product
     */
    public ProductClient $product;

    /**
     * @var TalentClient $talent
     */
    public TalentClient $talent;

    /**
     * @var UnitEconomicsClient $unitEconomics
     */
    public UnitEconomicsClient $unitEconomics;

    /**
     * @var MetadataClient $metadata
     */
    public MetadataClient $metadata;

    /**
     * @var BenchmarkClient $benchmark
     */
    public BenchmarkClient $benchmark;

    /**
     * @var ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   headers?: array<string, string>,
     * } $options
     */
    private ?array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param ?string $token The token to use for authentication.
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        ?string $token = null,
        ?array $options = null,
    ) {
        $defaultHeaders = [
            'X-Fern-Language' => 'PHP',
            'X-Fern-SDK-Name' => 'NewDemo',
            'X-Fern-SDK-Version' => '0.1.0',
        ];
        if ($token != null) {
            $defaultHeaders['Authorization'] = "Bearer $token";
        }

        $this->options = $options ?? [];
        $this->options['headers'] = array_merge(
            $defaultHeaders,
            $this->options['headers'] ?? [],
        );

        $this->client = new RawClient(
            options: $this->options,
        );

        $this->user = new UserClient($this->client);
        $this->group = new GroupClient($this->client);
        $this->macro = new MacroClient($this->client);
        $this->company = new CompanyClient($this->client);
        $this->deal = new DealClient($this->client);
        $this->file = new FileClient($this->client);
        $this->financials = new FinancialsClient($this->client);
        $this->product = new ProductClient($this->client);
        $this->talent = new TalentClient($this->client);
        $this->unitEconomics = new UnitEconomicsClient($this->client);
        $this->metadata = new MetadataClient($this->client);
        $this->benchmark = new BenchmarkClient($this->client);
    }

    /**
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return HealthzResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function healthz(?array $options = null): HealthzResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/healthz",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return HealthzResponse::fromJson($json);
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
