<?php

namespace NewDemo\Company\Requests;

use NewDemo\Core\Json\JsonSerializableType;

class CompanyGetByDomainRequest extends JsonSerializableType
{
    /**
     * @var string $domain
     */
    public string $domain;

    /**
     * @param array{
     *   domain: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->domain = $values['domain'];
    }
}
