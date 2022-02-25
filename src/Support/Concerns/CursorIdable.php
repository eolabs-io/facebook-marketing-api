<?php

namespace EolabsIo\FacebookMarketingApi\Support\Concerns;

use Illuminate\Support\Collection;

trait CursorIdable
{
    /** @var string */
    private $nextCursor;

    /** @var string */
    private $afterCursor;

    /** @var string */
    private $previousCursor;

    /** @var string */
    private $beforeCursor;

    public function checkForCursor(Collection $results): self
    {
        $results = $results->toArray();

        $nextCursor = data_get($results, 'paging.next');
        $this->setNextCursor($nextCursor);

        $afterCursor = data_get($results, 'paging.cursors.after');
        $this->setAfterCursor($afterCursor);

        $previousCursor = data_get($results, 'paging.previous');
        $this->setPreviousCursor($previousCursor);

        $beforeCursor = data_get($results, 'paging.cursors.before');
        $this->setBeforeCursor($beforeCursor);

        return $this;
    }

    public function clearCursors(): self
    {
        $this->setNextCursor();
        $this->setPreviousCursor();

        return $this;
    }

    public function getNextCursor(): ?string
    {
        return $this->nextCursor;
    }

    public function setNextCursor(string $cursor = null): self
    {
        $this->nextCursor = $cursor;

        return $this;
    }

    public function hasNextCursor(): bool
    {
        return filled($this->getNextCursor());
    }

    public function setAfterCursor(string $cursor = null): self
    {
        $this->afterCursor = $cursor;

        return $this;
    }

    public function getAfterCursor(): ?string
    {
        return $this->afterCursor;
    }

    public function setPreviousCursor(string $cursor = null): self
    {
        $this->previousCursor = $cursor;

        return $this;
    }

    public function hasPreviousCursor(): bool
    {
        return filled($this->getPreviousCursor());
    }

    public function setBeforeCursor(string $cursor = null): self
    {
        $this->beforeCursor = $cursor;

        return $this;
    }

    public function getBeforeCursor(): ?string
    {
        return $this->beforeCursor;
    }

    public function getNextCursorParamters(): array
    {
        return ($this->hasNextCursor())
                    ? ['after' => $this->getAfterCursor()]
                    : [];
    }

    public function getPreviousCursorParamters(): array
    {
        return ($this->hasPreviousCursor())
                    ?['before' => $this->getBeforeCursor()]
                    : [];
    }
}
