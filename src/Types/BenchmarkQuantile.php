<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;

class BenchmarkQuantile extends JsonSerializableType
{
    /**
     * @var float $quantile Quantile
     */
    #[JsonProperty('quantile')]
    public float $quantile;

    /**
     * @var ?float $revenue Revenue
     */
    #[JsonProperty('revenue')]
    public ?float $revenue;

    /**
     * @var ?float $rolling3MAverageRevenue Average Revenue (Rolling Q)
     */
    #[JsonProperty('rolling_3m_average_revenue')]
    public ?float $rolling3MAverageRevenue;

    /**
     * @var ?float $annualizedRevenue Annualized Revenue
     */
    #[JsonProperty('annualized_revenue')]
    public ?float $annualizedRevenue;

    /**
     * @var ?float $rolling3MAnnualizedRevenue Annualized Revenue (Rolling Q)
     */
    #[JsonProperty('rolling_3m_annualized_revenue')]
    public ?float $rolling3MAnnualizedRevenue;

    /**
     * @var ?float $revenueShareOfTop20Percent Revenue Share of Top 20%
     */
    #[JsonProperty('revenue_share_of_top_20_percent')]
    public ?float $revenueShareOfTop20Percent;

    /**
     * @var ?float $revenueShareOfTop10Count Revenue Share of Top 10 Users
     */
    #[JsonProperty('revenue_share_of_top_10_count')]
    public ?float $revenueShareOfTop10Count;

    /**
     * @var ?float $averageToMedian Average to Median Revenue
     */
    #[JsonProperty('average_to_median')]
    public ?float $averageToMedian;

    /**
     * @var ?float $giniCoefficient Gini Coefficient
     */
    #[JsonProperty('gini_coefficient')]
    public ?float $giniCoefficient;

    /**
     * @var ?float $lifetimeQuickRatio Average Quick Ratio
     */
    #[JsonProperty('lifetime_quick_ratio')]
    public ?float $lifetimeQuickRatio;

    /**
     * @var ?float $lifetimeGrossRetention Average Gross Retention
     */
    #[JsonProperty('lifetime_gross_retention')]
    public ?float $lifetimeGrossRetention;

    /**
     * @var ?float $lifetimeNetChurn Average Net Churn
     */
    #[JsonProperty('lifetime_net_churn')]
    public ?float $lifetimeNetChurn;

    /**
     * @var ?float $cmgr3 CMGR3
     */
    #[JsonProperty('cmgr3')]
    public ?float $cmgr3;

    /**
     * @var ?float $cmgr6 CMGR6
     */
    #[JsonProperty('cmgr6')]
    public ?float $cmgr6;

    /**
     * @var ?float $cmgr12 CMGR12
     */
    #[JsonProperty('cmgr12')]
    public ?float $cmgr12;

    /**
     * @var ?float $yoy YoY Growth
     */
    #[JsonProperty('yoy')]
    public ?float $yoy;

    /**
     * @var ?float $operatingMargin Operating Margin
     */
    #[JsonProperty('operating_margin')]
    public ?float $operatingMargin;

    /**
     * @var ?float $quarterlyOperatingMargin Operating Margin (Rolling Q)
     */
    #[JsonProperty('quarterly_operating_margin')]
    public ?float $quarterlyOperatingMargin;

    /**
     * @var ?float $grossMargin Gross Margin
     */
    #[JsonProperty('gross_margin')]
    public ?float $grossMargin;

    /**
     * @var ?float $quarterlyGrossMargin Gross Margin (Rolling Q)
     */
    #[JsonProperty('quarterly_gross_margin')]
    public ?float $quarterlyGrossMargin;

    /**
     * @var ?float $magicNumber Magic Number
     */
    #[JsonProperty('magic_number')]
    public ?float $magicNumber;

    /**
     * @var ?float $ruleOf40 Rule of 40
     */
    #[JsonProperty('rule_of_40')]
    public ?float $ruleOf40;

    /**
     * @var ?float $burnMultiple Burn Multiple
     */
    #[JsonProperty('burn_multiple')]
    public ?float $burnMultiple;

    /**
     * @var ?float $acquisitionSpend Acquisition Spend
     */
    #[JsonProperty('acquisition_spend')]
    public ?float $acquisitionSpend;

    /**
     * @var ?float $totalOpex Total OPEX
     */
    #[JsonProperty('total_opex')]
    public ?float $totalOpex;

    /**
     * @var ?float $logoRetention6M Logo Retention (6M)
     */
    #[JsonProperty('logo_retention_6m')]
    public ?float $logoRetention6M;

    /**
     * @var ?float $logoRetention12M Logo Retention (12M)
     */
    #[JsonProperty('logo_retention_12m')]
    public ?float $logoRetention12M;

    /**
     * @var ?float $revenueRetention6M Revenue Retention (6M)
     */
    #[JsonProperty('revenue_retention_6m')]
    public ?float $revenueRetention6M;

    /**
     * @var ?float $revenueRetention12M Revenue Retention (12M)
     */
    #[JsonProperty('revenue_retention_12m')]
    public ?float $revenueRetention12M;

    /**
     * @var ?float $ltv6M LTV6
     */
    #[JsonProperty('ltv_6m')]
    public ?float $ltv6M;

    /**
     * @var ?float $ltv12M LTV12
     */
    #[JsonProperty('ltv_12m')]
    public ?float $ltv12M;

    /**
     * @var ?float $ltv6Cac LTV6/CAC
     */
    #[JsonProperty('ltv6_cac')]
    public ?float $ltv6Cac;

    /**
     * @var ?float $ltv12Cac LTV12/CAC
     */
    #[JsonProperty('ltv12_cac')]
    public ?float $ltv12Cac;

    /**
     * @var ?float $gmltv6Cac gmLTV6/CAC
     */
    #[JsonProperty('gmltv6_cac')]
    public ?float $gmltv6Cac;

    /**
     * @var ?float $gmltv12Cac gmLTV12/CAC
     */
    #[JsonProperty('gmltv12_cac')]
    public ?float $gmltv12Cac;

    /**
     * @var ?float $lifetimeLtv6Cac Average LTV6/CAC
     */
    #[JsonProperty('lifetime_ltv6_cac')]
    public ?float $lifetimeLtv6Cac;

    /**
     * @var ?float $lifetimeLtv12Cac Average LTV12/CAC
     */
    #[JsonProperty('lifetime_ltv12_cac')]
    public ?float $lifetimeLtv12Cac;

    /**
     * @var ?float $lifetimeGmltv6Cac Average gmLTV6/CAC
     */
    #[JsonProperty('lifetime_gmltv6_cac')]
    public ?float $lifetimeGmltv6Cac;

    /**
     * @var ?float $lifetimeGmltv12Cac Average gmLTV12/CAC
     */
    #[JsonProperty('lifetime_gmltv12_cac')]
    public ?float $lifetimeGmltv12Cac;

    /**
     * @var ?float $cac CAC
     */
    #[JsonProperty('cac')]
    public ?float $cac;

    /**
     * @var ?float $irr IRR
     */
    #[JsonProperty('irr')]
    public ?float $irr;

    /**
     * @var ?float $periodsToPayback Months to Payback
     */
    #[JsonProperty('periods_to_payback')]
    public ?float $periodsToPayback;

    /**
     * @var ?float $employeeCount Number of Employees
     */
    #[JsonProperty('employee_count')]
    public ?float $employeeCount;

    /**
     * @var ?float $cumulativePersonYears Cumulative Years of Effort
     */
    #[JsonProperty('cumulative_person_years')]
    public ?float $cumulativePersonYears;

    /**
     * @var ?float $employeeRetention1Yr Employee Retention (1Y)
     */
    #[JsonProperty('employee_retention_1yr')]
    public ?float $employeeRetention1Yr;

    /**
     * @var ?float $employeeRetention2Yr Employee Retention (2Y)
     */
    #[JsonProperty('employee_retention_2yr')]
    public ?float $employeeRetention2Yr;

    /**
     * @var ?float $averageYearsOfExperience Average Employee Experience (Years)
     */
    #[JsonProperty('average_years_of_experience')]
    public ?float $averageYearsOfExperience;

    /**
     * @var ?float $lifetimeEmployeeRetention Lifetime Employee Retention
     */
    #[JsonProperty('lifetime_employee_retention')]
    public ?float $lifetimeEmployeeRetention;

    /**
     * @var ?float $percentEmployeesSalesAndMarketing Sales + Marketing (% Employees)
     */
    #[JsonProperty('percent_employees_sales_and_marketing')]
    public ?float $percentEmployeesSalesAndMarketing;

    /**
     * @var ?float $fullyLoadedEmployeeCost Fully-Loaded Employee Cost
     */
    #[JsonProperty('fully_loaded_employee_cost')]
    public ?float $fullyLoadedEmployeeCost;

    /**
     * @var ?float $annualizedRevenuePerEmployee Annualized Revenue per Employee
     */
    #[JsonProperty('annualized_revenue_per_employee')]
    public ?float $annualizedRevenuePerEmployee;

    /**
     * @param array{
     *   quantile: float,
     *   revenue?: ?float,
     *   rolling3MAverageRevenue?: ?float,
     *   annualizedRevenue?: ?float,
     *   rolling3MAnnualizedRevenue?: ?float,
     *   revenueShareOfTop20Percent?: ?float,
     *   revenueShareOfTop10Count?: ?float,
     *   averageToMedian?: ?float,
     *   giniCoefficient?: ?float,
     *   lifetimeQuickRatio?: ?float,
     *   lifetimeGrossRetention?: ?float,
     *   lifetimeNetChurn?: ?float,
     *   cmgr3?: ?float,
     *   cmgr6?: ?float,
     *   cmgr12?: ?float,
     *   yoy?: ?float,
     *   operatingMargin?: ?float,
     *   quarterlyOperatingMargin?: ?float,
     *   grossMargin?: ?float,
     *   quarterlyGrossMargin?: ?float,
     *   magicNumber?: ?float,
     *   ruleOf40?: ?float,
     *   burnMultiple?: ?float,
     *   acquisitionSpend?: ?float,
     *   totalOpex?: ?float,
     *   logoRetention6M?: ?float,
     *   logoRetention12M?: ?float,
     *   revenueRetention6M?: ?float,
     *   revenueRetention12M?: ?float,
     *   ltv6M?: ?float,
     *   ltv12M?: ?float,
     *   ltv6Cac?: ?float,
     *   ltv12Cac?: ?float,
     *   gmltv6Cac?: ?float,
     *   gmltv12Cac?: ?float,
     *   lifetimeLtv6Cac?: ?float,
     *   lifetimeLtv12Cac?: ?float,
     *   lifetimeGmltv6Cac?: ?float,
     *   lifetimeGmltv12Cac?: ?float,
     *   cac?: ?float,
     *   irr?: ?float,
     *   periodsToPayback?: ?float,
     *   employeeCount?: ?float,
     *   cumulativePersonYears?: ?float,
     *   employeeRetention1Yr?: ?float,
     *   employeeRetention2Yr?: ?float,
     *   averageYearsOfExperience?: ?float,
     *   lifetimeEmployeeRetention?: ?float,
     *   percentEmployeesSalesAndMarketing?: ?float,
     *   fullyLoadedEmployeeCost?: ?float,
     *   annualizedRevenuePerEmployee?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->quantile = $values['quantile'];
        $this->revenue = $values['revenue'] ?? null;
        $this->rolling3MAverageRevenue = $values['rolling3MAverageRevenue'] ?? null;
        $this->annualizedRevenue = $values['annualizedRevenue'] ?? null;
        $this->rolling3MAnnualizedRevenue = $values['rolling3MAnnualizedRevenue'] ?? null;
        $this->revenueShareOfTop20Percent = $values['revenueShareOfTop20Percent'] ?? null;
        $this->revenueShareOfTop10Count = $values['revenueShareOfTop10Count'] ?? null;
        $this->averageToMedian = $values['averageToMedian'] ?? null;
        $this->giniCoefficient = $values['giniCoefficient'] ?? null;
        $this->lifetimeQuickRatio = $values['lifetimeQuickRatio'] ?? null;
        $this->lifetimeGrossRetention = $values['lifetimeGrossRetention'] ?? null;
        $this->lifetimeNetChurn = $values['lifetimeNetChurn'] ?? null;
        $this->cmgr3 = $values['cmgr3'] ?? null;
        $this->cmgr6 = $values['cmgr6'] ?? null;
        $this->cmgr12 = $values['cmgr12'] ?? null;
        $this->yoy = $values['yoy'] ?? null;
        $this->operatingMargin = $values['operatingMargin'] ?? null;
        $this->quarterlyOperatingMargin = $values['quarterlyOperatingMargin'] ?? null;
        $this->grossMargin = $values['grossMargin'] ?? null;
        $this->quarterlyGrossMargin = $values['quarterlyGrossMargin'] ?? null;
        $this->magicNumber = $values['magicNumber'] ?? null;
        $this->ruleOf40 = $values['ruleOf40'] ?? null;
        $this->burnMultiple = $values['burnMultiple'] ?? null;
        $this->acquisitionSpend = $values['acquisitionSpend'] ?? null;
        $this->totalOpex = $values['totalOpex'] ?? null;
        $this->logoRetention6M = $values['logoRetention6M'] ?? null;
        $this->logoRetention12M = $values['logoRetention12M'] ?? null;
        $this->revenueRetention6M = $values['revenueRetention6M'] ?? null;
        $this->revenueRetention12M = $values['revenueRetention12M'] ?? null;
        $this->ltv6M = $values['ltv6M'] ?? null;
        $this->ltv12M = $values['ltv12M'] ?? null;
        $this->ltv6Cac = $values['ltv6Cac'] ?? null;
        $this->ltv12Cac = $values['ltv12Cac'] ?? null;
        $this->gmltv6Cac = $values['gmltv6Cac'] ?? null;
        $this->gmltv12Cac = $values['gmltv12Cac'] ?? null;
        $this->lifetimeLtv6Cac = $values['lifetimeLtv6Cac'] ?? null;
        $this->lifetimeLtv12Cac = $values['lifetimeLtv12Cac'] ?? null;
        $this->lifetimeGmltv6Cac = $values['lifetimeGmltv6Cac'] ?? null;
        $this->lifetimeGmltv12Cac = $values['lifetimeGmltv12Cac'] ?? null;
        $this->cac = $values['cac'] ?? null;
        $this->irr = $values['irr'] ?? null;
        $this->periodsToPayback = $values['periodsToPayback'] ?? null;
        $this->employeeCount = $values['employeeCount'] ?? null;
        $this->cumulativePersonYears = $values['cumulativePersonYears'] ?? null;
        $this->employeeRetention1Yr = $values['employeeRetention1Yr'] ?? null;
        $this->employeeRetention2Yr = $values['employeeRetention2Yr'] ?? null;
        $this->averageYearsOfExperience = $values['averageYearsOfExperience'] ?? null;
        $this->lifetimeEmployeeRetention = $values['lifetimeEmployeeRetention'] ?? null;
        $this->percentEmployeesSalesAndMarketing = $values['percentEmployeesSalesAndMarketing'] ?? null;
        $this->fullyLoadedEmployeeCost = $values['fullyLoadedEmployeeCost'] ?? null;
        $this->annualizedRevenuePerEmployee = $values['annualizedRevenuePerEmployee'] ?? null;
    }
}
