<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class IncomeStatementEntry extends JsonSerializableType
{
    /**
     * @var string $date The date of the entry.
     */
    #[JsonProperty('date')]
    public string $date;

    /**
     * @var string $category The category of the entry.
     */
    #[JsonProperty('category')]
    public string $category;

    /**
     * @var string $field The original field name of the entry.
     */
    #[JsonProperty('field')]
    public string $field;

    /**
     * @var ?float $value The value of the entry.
     */
    #[JsonProperty('value')]
    public ?float $value;

    /**
     * @param array{
     *   date: string,
     *   category: string,
     *   field: string,
     *   value?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->date = $values['date'];
        $this->category = $values['category'];
        $this->field = $values['field'];
        $this->value = $values['value'] ?? null;
    }
}
