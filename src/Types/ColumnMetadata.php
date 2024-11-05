<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class ColumnMetadata extends JsonSerializableType
{
    /**
     * @var string $name The name of the column.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $friendlyName The friendly displayable name of the column.
     */
    #[JsonProperty('friendly_name')]
    public string $friendlyName;

    /**
     * @var value-of<Unit> $unit The unit of the category.
     */
    #[JsonProperty('unit')]
    public string $unit;

    /**
     * @var value-of<Scaling> $scaling The scaling type of the column. Geometric indicates exponential changes are expected, while arithmetic indicates linear changes.
     */
    #[JsonProperty('scaling')]
    public string $scaling;

    /**
     * @var bool $reverse Whether the column is expected to be higher or lower for better performance. False means higher is better, True means lower is better.
     */
    #[JsonProperty('reverse')]
    public bool $reverse;

    /**
     * @var ?float $cutoff The **suggested** cutoff value for the column. This is a guideline for when the absolute value of the column is considered saturated.
     */
    #[JsonProperty('cutoff')]
    public ?float $cutoff;

    /**
     * @param array{
     *   name: string,
     *   friendlyName: string,
     *   unit: value-of<Unit>,
     *   scaling: value-of<Scaling>,
     *   reverse: bool,
     *   cutoff?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->friendlyName = $values['friendlyName'];
        $this->unit = $values['unit'];
        $this->scaling = $values['scaling'];
        $this->reverse = $values['reverse'];
        $this->cutoff = $values['cutoff'] ?? null;
    }
}
