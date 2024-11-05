<?php

namespace NewDemo\File;

use NewDemo\Core\Client\RawClient;
use NewDemo\File\Requests\BodyUploadFile;
use NewDemo\Types\CreateFileResponse;
use NewDemo\Exceptions\NewDemoException;
use NewDemo\Exceptions\NewDemoApiException;
use NewDemo\Core\Multipart\MultipartFormData;
use NewDemo\Core\Multipart\MultipartApiRequest;
use NewDemo\Environments;
use NewDemo\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use NewDemo\File\Requests\FileRequest;
use NewDemo\Types\CreateFileForSignedUrlResponse;
use NewDemo\Core\Json\JsonApiRequest;
use NewDemo\File\Requests\FileListRequest;
use NewDemo\Types\PaginatedResponseFileResponse;
use NewDemo\Types\FileResponse;
use NewDemo\File\Requests\UpdateFileRequest;
use NewDemo\File\Requests\FileDeleteRequest;
use NewDemo\Core\Json\JsonDecoder;
use NewDemo\File\Requests\FileReadUrlRequest;
use NewDemo\Types\GcsSignedUrlResponse;

class FileClient
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
     * Upload a file for a specific group and deal. Creates a file entry as well as uploads its contents.
     * NOTE: Uploads are limited to 10 GB. For larger file uploads use the signed-url upload endpoint.
     *
     * @param int $dealId
     * @param int $groupId
     * @param BodyUploadFile $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return CreateFileResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function upload(int $dealId, int $groupId, BodyUploadFile $request, ?array $options = null): CreateFileResponse
    {
        $body = new MultipartFormData();
        $body->addPart($request->file->toMultipartFormDataPart('file'));
        $body->add(name: 'name', value: $request->name);
        $body->add(name: 'filetype', value: $request->filetype);
        try {
            $response = $this->client->sendRequest(
                new MultipartApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/file",
                    method: HttpMethod::POST,
                    body: $body,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CreateFileResponse::fromJson($json);
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
     * Create a new file entry for a specific group and deal. Requires the contents to be uploaded separately via signed-url.
     *
     * @param int $dealId
     * @param int $groupId
     * @param FileRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return CreateFileForSignedUrlResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function createFileEntry(int $dealId, int $groupId, FileRequest $request, ?array $options = null): CreateFileForSignedUrlResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/file/entry",
                    method: HttpMethod::POST,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CreateFileForSignedUrlResponse::fromJson($json);
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
     * Get all files for a specific group and deal.
     *
     * @param int $dealId
     * @param int $groupId
     * @param FileListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return PaginatedResponseFileResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function list(int $dealId, int $groupId, FileListRequest $request, ?array $options = null): PaginatedResponseFileResponse
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
                    path: "api/v1/group/$groupId/deal/$dealId/file/all",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return PaginatedResponseFileResponse::fromJson($json);
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
     * Get a file by its ID for a specific group and deal.
     *
     * @param int $dealId
     * @param int $fileId
     * @param int $groupId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return FileResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function get(int $dealId, int $fileId, int $groupId, ?array $options = null): FileResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/file/$fileId",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return FileResponse::fromJson($json);
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
     * Update a file by its ID for a specific group and deal.
     *
     * @param int $fileId
     * @param int $groupId
     * @param int $dealId
     * @param UpdateFileRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return FileResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function update(int $fileId, int $groupId, int $dealId, UpdateFileRequest $request, ?array $options = null): FileResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/file/$fileId",
                    method: HttpMethod::PUT,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return FileResponse::fromJson($json);
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
     * Delete a file by its ID for a specific group and deal.
     *
     * @param int $fileId
     * @param int $groupId
     * @param int $dealId
     * @param FileDeleteRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return mixed
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function delete(int $fileId, int $groupId, int $dealId, FileDeleteRequest $request, ?array $options = null): mixed
    {
        $query = [];
        if ($request->archive != null) {
            $query['archive'] = $request->archive;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/file/$fileId",
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

    /**
     * Download a file by its ID for a specific group and deal.
     * NOTE: Downloads are limited to 10 GB. For larger file downloads use the signed-url download endpoint.
     *
     * @param int $dealId
     * @param int $fileId
     * @param int $groupId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return mixed
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function download(int $dealId, int $fileId, int $groupId, ?array $options = null): mixed
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/file/$fileId/download",
                    method: HttpMethod::GET,
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

    /**
     * Get a signed URL to read a file by its ID for a specific group and deal.
     *
     * @param int $dealId
     * @param int $fileId
     * @param int $groupId
     * @param FileReadUrlRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return GcsSignedUrlResponse
     * @throws NewDemoException
     * @throws NewDemoApiException
     */
    public function readUrl(int $dealId, int $fileId, int $groupId, FileReadUrlRequest $request, ?array $options = null): GcsSignedUrlResponse
    {
        $query = [];
        if ($request->contentType != null) {
            $query['content_type'] = $request->contentType;
        }
        if ($request->download != null) {
            $query['download'] = $request->download;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "api/v1/group/$groupId/deal/$dealId/file/$fileId/signed-url",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return GcsSignedUrlResponse::fromJson($json);
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
