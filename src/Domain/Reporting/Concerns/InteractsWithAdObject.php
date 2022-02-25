<?php
namespace EolabsIo\FacebookMarketingApi\Domain\Reporting\Concerns;

trait InteractsWithAdObject
{
    /* @var string */
    private $adObject;


    public function withAdAccountId($id): self
    {
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
