<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

/**
 * Represents the basic growth accounting metrics for the user count.
 */
class UserAccountingResponse extends JsonSerializableType
{
    /**
     * @var string $date The date of the entry.
     */
    #[JsonProperty('date')]
    public string $date;

    /**
     * @var int $activeUsers The number of active users in the period.
     */
    #[JsonProperty('active_users')]
    public int $activeUsers;

    /**
     * @var ?int $retained The number of retained users from the last period in the current period.
     */
    #[JsonProperty('retained')]
    public ?int $retained;

    /**
     * @var ?int $new The number of new users in the period.
     */
    #[JsonProperty('new')]
    public ?int $new;

    /**
     * @var ?int $resurrected The number of resurrected users in the period.
     */
    #[JsonProperty('resurrected')]
    public ?int $resurrected;

    /**
     * @var ?int $churned The number of churned users in the period.
     */
    #[JsonProperty('churned')]
    public ?int $churned;

    /**
     * @var ?float $cmgr3 3-month user count growth rate, for monthly frequency.
     */
    #[JsonProperty('cmgr3')]
    public ?float $cmgr3;

    /**
     * @var ?float $cmgr6 6-month user count growth rate, for monthly frequency.
     */
    #[JsonProperty('cmgr6')]
    public ?float $cmgr6;

    /**
     * @var ?float $cmgr12 12-month user count growth rate, for monthly frequency.
     */
    #[JsonProperty('cmgr12')]
    public ?float $cmgr12;

    /**
     * @var ?float $cqgr1 1-quarter user count growth rate, for quarterly frequency.
     */
    #[JsonProperty('cqgr1')]
    public ?float $cqgr1;

    /**
     * @var ?float $cqgr2 2-quarter user count growth rate, for quarterly frequency.
     */
    #[JsonProperty('cqgr2')]
    public ?float $cqgr2;

    /**
     * @var ?float $cqgr4 4-quarter user count growth rate, for quarterly frequency.
     */
    #[JsonProperty('cqgr4')]
    public ?float $cqgr4;

    /**
     * @var ?float $logoRetention The logo retention rate, defined as retained / active over last period.
     */
    #[JsonProperty('logo_retention')]
    public ?float $logoRetention;

    /**
     * @var ?float $quickRatio The quick ratio, defined as (resurrected + new) / churned.
     */
    #[JsonProperty('quick_ratio')]
    public ?float $quickRatio;

    /**
     * @param array{
     *   date: string,
     *   activeUsers: int,
     *   retained?: ?int,
     *   new?: ?int,
     *   resurrected?: ?int,
     *   churned?: ?int,
     *   cmgr3?: ?float,
     *   cmgr6?: ?float,
     *   cmgr12?: ?float,
     *   cqgr1?: ?float,
     *   cqgr2?: ?float,
     *   cqgr4?: ?float,
     *   logoRetention?: ?float,
     *   quickRatio?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->date = $values['date'];
        $this->activeUsers = $values['activeUsers'];
        $this->retained = $values['retained'] ?? null;
        $this->new = $values['new'] ?? null;
        $this->resurrected = $values['resurrected'] ?? null;
        $this->churned = $values['churned'] ?? null;
        $this->cmgr3 = $values['cmgr3'] ?? null;
        $this->cmgr6 = $values['cmgr6'] ?? null;
        $this->cmgr12 = $values['cmgr12'] ?? null;
        $this->cqgr1 = $values['cqgr1'] ?? null;
        $this->cqgr2 = $values['cqgr2'] ?? null;
        $this->cqgr4 = $values['cqgr4'] ?? null;
        $this->logoRetention = $values['logoRetention'] ?? null;
        $this->quickRatio = $values['quickRatio'] ?? null;
    }
}
