<?php
namespace EolabsIo\FacebookMarketingApi\Domain\Reporting\Concerns;

trait InteractsWithAdObject
{
    /* @var string */
    private $adObject;


    public function withAdAccountId($id = null): self
    {
        $id = $id ?? config('facebook-marketing-api.ad_account_id');
        $this->adObject = "act_{$id}";

        return $this;
    }

    public function withCampaignId($id): self
    {
        $this->adObject = $id;

        return $this;
    }

    public function withAdSetId($id): self
    {
        $this->adObject = $id;

        return $this;
    }

    public function withAdId($id): self
    {
        $this->adObject = $id;

        return $this;
    }

    public function getAdObject(): string
    {
        return $this->adObject;
    }
}
