<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class FinancialMetrics extends JsonSerializableType
{
    /**
     * @var string $date The date of the financial metrics.
     */
    #[JsonProperty('date')]
    public string $date;

    /**
     * @var ?float $lifetimeGrossMargin The lifetime gross margin, integrated over all time.
     */
    #[JsonProperty('lifetime_gross_margin')]
    public ?float $lifetimeGrossMargin;

    /**
     * @var ?float $lifetimeOperatingMargin The lifetime operating margin, integrated over all time.
     */
    #[JsonProperty('lifetime_operating_margin')]
    public ?float $lifetimeOperatingMargin;

    /**
     * @var ?float $ruleOf40 The rule of 40, defined as the year over year growth plus the operating margin, with slight smoothing to handle variations.
     */
    #[JsonProperty('rule_of_40')]
    public ?float $ruleOf40;

    /**
     * @var ?float $magicNumber The magic number, defined as the revenue growth divided by the offset sales and marketing cost, with slight smoothing to handle variations.
     */
    #[JsonProperty('magic_number')]
    public ?float $magicNumber;

    /**
     * @var ?float $burnMultiple The burn multiple, defined as the cash burn divided by the revenue growth, with slight smoothing to handle variations. The operating margin is used in place of the cash burn if the cash burn is not available. Not defined if the revenue growth is negative.
     */
    #[JsonProperty('burn_multiple')]
    public ?float $burnMultiple;

    /**
     * @param array{
     *   date: string,
     *   lifetimeGrossMargin?: ?float,
     *   lifetimeOperatingMargin?: ?float,
     *   ruleOf40?: ?float,
     *   magicNumber?: ?float,
     *   burnMultiple?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->date = $values['date'];
        $this->lifetimeGrossMargin = $values['lifetimeGrossMargin'] ?? null;
        $this->lifetimeOperatingMargin = $values['lifetimeOperatingMargin'] ?? null;
        $this->ruleOf40 = $values['ruleOf40'] ?? null;
        $this->magicNumber = $values['magicNumber'] ?? null;
        $this->burnMultiple = $values['burnMultiple'] ?? null;
    }
}
