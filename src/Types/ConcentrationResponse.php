<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

/**
 * A collection of concentration measurements of the amount.
 *
 * The "amount" is a generic term for the metric being measured, such as revenue or gtv.
 */
class ConcentrationResponse extends JsonSerializableType
{
    /**
     * @var ?array<ConcentrationTimeseriesDetail> $timeSeriesMetrics The time series metrics for the concentration of the amount. The top 5, 10, and 20 users are shown, as well as the top 10% and 20% of users, and some other supporting aggregate concentration metrics.
     */
    #[JsonProperty('time_series_metrics'), ArrayType([ConcentrationTimeseriesDetail::class])]
    public ?array $timeSeriesMetrics;

    /**
     * @var ?array<ConcentrationEndpointTopUsersDetail> $endpointTopUsers Detail for the top users at the endpoint. Up to the top 100 users are show.
     */
    #[JsonProperty('endpoint_top_users'), ArrayType([ConcentrationEndpointTopUsersDetail::class])]
    public ?array $endpointTopUsers;

    /**
     * @var ?array<ConcentrationEndpointCdfDetail> $endpointCdf The detailed cumulative distribution function (CDF). The CDF is presented at the top 100 users, and beyond that it is presented at approximately evenly spaced quantiles. This approach enables robustness to extremely large user bases. The CDF is presented for both users and amount.
     */
    #[JsonProperty('endpoint_cdf'), ArrayType([ConcentrationEndpointCdfDetail::class])]
    public ?array $endpointCdf;

    /**
     * @param array{
     *   timeSeriesMetrics?: ?array<ConcentrationTimeseriesDetail>,
     *   endpointTopUsers?: ?array<ConcentrationEndpointTopUsersDetail>,
     *   endpointCdf?: ?array<ConcentrationEndpointCdfDetail>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->timeSeriesMetrics = $values['timeSeriesMetrics'] ?? null;
        $this->endpointTopUsers = $values['endpointTopUsers'] ?? null;
        $this->endpointCdf = $values['endpointCdf'] ?? null;
    }
}
