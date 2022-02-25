<?php
namespace EolabsIo\FacebookMarketingApi\Domain\Shared\Models;

use EolabsIo\FacebookMarketingApi\Database\Factories\AdSetFactory;

class AdSet extends FacebookMarketingApiModel
{

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'id',
                    'name',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return AdSetFactory::new();
    }

}
