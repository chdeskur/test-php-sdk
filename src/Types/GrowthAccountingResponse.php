<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

/**
 * Represents the basic growth-accounting metrics for the amount.
 *
 * The "amount" is a generic term for the metric being measured, such as revenue or gtv.
 */
class GrowthAccountingResponse extends JsonSerializableType
{
    /**
     * @var string $date The date of the entry.
     */
    #[JsonProperty('date')]
    public string $date;

    /**
     * @var float $amount The amount, such as revenue or gtv, in the period.
     */
    #[JsonProperty('amount')]
    public float $amount;

    /**
     * @var ?float $retained The retained amount from the last period in the current period.
     */
    #[JsonProperty('retained')]
    public ?float $retained;

    /**
     * @var ?float $new The number of new users in the period.
     */
    #[JsonProperty('new')]
    public ?float $new;

    /**
     * @var ?float $resurrected The number of resurrected users in the period.
     */
    #[JsonProperty('resurrected')]
    public ?float $resurrected;

    /**
     * @var ?float $expansion The amount of expansion in the period.
     */
    #[JsonProperty('expansion')]
    public ?float $expansion;

    /**
     * @var ?float $contraction The amount of contraction in the period.
     */
    #[JsonProperty('contraction')]
    public ?float $contraction;

    /**
     * @var ?float $churned The number of churned users in the period.
     */
    #[JsonProperty('churned')]
    public ?float $churned;

    /**
     * @var ?float $cmgr3 3-month amount growth rate, for monthly frequency.
     */
    #[JsonProperty('cmgr3')]
    public ?float $cmgr3;

    /**
     * @var ?float $cmgr6 6-month amount growth rate, for monthly frequency.
     */
    #[JsonProperty('cmgr6')]
    public ?float $cmgr6;

    /**
     * @var ?float $cmgr12 12-month amount growth rate, for monthly frequency.
     */
    #[JsonProperty('cmgr12')]
    public ?float $cmgr12;

    /**
     * @var ?float $cqgr1 1-quarter amount growth rate, for quarterly frequency.
     */
    #[JsonProperty('cqgr1')]
    public ?float $cqgr1;

    /**
     * @var ?float $cqgr2 2-quarter amount growth rate, for quarterly frequency.
     */
    #[JsonProperty('cqgr2')]
    public ?float $cqgr2;

    /**
     * @var ?float $cqgr4 4-quarter amount growth rate, for quarterly frequency.
     */
    #[JsonProperty('cqgr4')]
    public ?float $cqgr4;

    /**
     * @var ?float $quickRatio The quick ratio, defined as (new + resurrected + expansion) / (churned + contraction).
     */
    #[JsonProperty('quick_ratio')]
    public ?float $quickRatio;

    /**
     * @var ?float $grossRetention The gross retention rate, defined as retained / last period amount.
     */
    #[JsonProperty('gross_retention')]
    public ?float $grossRetention;

    /**
     * @var ?float $netChurn The net churn rate, defined as -(resurrected + expansion - churned - contraction) / last period amount. This is also known as 1 - net dollar retention. Negative values indicate net-expansion.
     */
    #[JsonProperty('net_churn')]
    public ?float $netChurn;

    /**
     * @var ?float $lifetimeQuickRatio The lifetime quick ratio, integrated over all time.
     */
    #[JsonProperty('lifetime_quick_ratio')]
    public ?float $lifetimeQuickRatio;

    /**
     * @var ?float $lifetimeGrossRetention The lifetime gross retention rate, integrated over all time.
     */
    #[JsonProperty('lifetime_gross_retention')]
    public ?float $lifetimeGrossRetention;

    /**
     * @var ?float $lifetimeNetChurn The lifetime net churn rate, integrated over all time. This is also known as 1 - lifetime net dollar retention. Negative values indicate net-expansion.
     */
    #[JsonProperty('lifetime_net_churn')]
    public ?float $lifetimeNetChurn;

    /**
     * @param array{
     *   date: string,
     *   amount: float,
     *   retained?: ?float,
     *   new?: ?float,
     *   resurrected?: ?float,
     *   expansion?: ?float,
     *   contraction?: ?float,
     *   churned?: ?float,
     *   cmgr3?: ?float,
     *   cmgr6?: ?float,
     *   cmgr12?: ?float,
     *   cqgr1?: ?float,
     *   cqgr2?: ?float,
     *   cqgr4?: ?float,
     *   quickRatio?: ?float,
     *   grossRetention?: ?float,
     *   netChurn?: ?float,
     *   lifetimeQuickRatio?: ?float,
     *   lifetimeGrossRetention?: ?float,
     *   lifetimeNetChurn?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->date = $values['date'];
        $this->amount = $values['amount'];
        $this->retained = $values['retained'] ?? null;
        $this->new = $values['new'] ?? null;
        $this->resurrected = $values['resurrected'] ?? null;
        $this->expansion = $values['expansion'] ?? null;
        $this->contraction = $values['contraction'] ?? null;
        $this->churned = $values['churned'] ?? null;
        $this->cmgr3 = $values['cmgr3'] ?? null;
        $this->cmgr6 = $values['cmgr6'] ?? null;
        $this->cmgr12 = $values['cmgr12'] ?? null;
        $this->cqgr1 = $values['cqgr1'] ?? null;
        $this->cqgr2 = $values['cqgr2'] ?? null;
        $this->cqgr4 = $values['cqgr4'] ?? null;
        $this->quickRatio = $values['quickRatio'] ?? null;
        $this->grossRetention = $values['grossRetention'] ?? null;
        $this->netChurn = $values['netChurn'] ?? null;
        $this->lifetimeQuickRatio = $values['lifetimeQuickRatio'] ?? null;
        $this->lifetimeGrossRetention = $values['lifetimeGrossRetention'] ?? null;
        $this->lifetimeNetChurn = $values['lifetimeNetChurn'] ?? null;
    }
}
