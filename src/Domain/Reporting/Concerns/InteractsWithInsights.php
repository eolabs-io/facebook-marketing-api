<?php
namespace EolabsIo\FacebookMarketingApi\Domain\Reporting\Concerns;

use Illuminate\Support\Carbon;

trait InteractsWithInsights
{
    /* @var array */
    private $insightsParameters = [];

    public function withInsightLevelAd(): self
    {
        return $this->withInsightLevel('ad');
    }

    public function withInsightLevelAdSet(): self
    {
        return $this->withInsightLevel('adset');
    }

    public function withInsightLevelCampaign(): self
    {
        return $this->withInsightLevel('campaign');
    }

    public function withInsightLevelAccount(): self
    {
        return $this->withInsightLevel('account');
    }

    public function withInsightLevel($level): self
    {
        $this->insightsParameters['level'] = $level;

        return $this;
    }

    public function withDatePresetToday(): self
    {
        return $this->withDatePreset('today');
    }

    public function withDatePresetYesterday(): self
    {
        return $this->withDatePreset('yesterday');
    }

    public function withDatePreset(string $datePreset): self
    {
        $this->insightsParameters['date_preset'] = $datePreset;

        return $this;
    }

    public function withInsightTimeRange(Carbon $since, Carbon $until): self
    {
        $this->insightsParameters['time_range'] = json_encode([
            'since' => $since->format('Y-m-d'),
            'until' => $until->format('Y-m-d')
        ]);

        return $this;
    }

    public function withInsightDatePreset($datePreset): self
    {
        $this->insightsParameters['date_preset'] = $datePreset;

        return $this;
    }

    public function withInsightFields(array $fields): self
    {
        $this->insightsParameters['fields'] = implode(",", $fields);

        return $this;
    }

    public function getInsightsParameters(): array
    {
        return $this->insightsParameters;
    }
}
