<?php

namespace EolabsIo\FacebookMarketingApi\Domain\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class FacebookMarketingApiModel extends Model
{
    use HasFactory;

    /**
     * Get the current connection name for the model.
     *
     * @return string|null
     */
    public function getConnectionName()
    {
        return config('facebook-marketing-api.database.connection') ?? $this->connection;
    }
}
