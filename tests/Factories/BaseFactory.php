<?php

namespace EolabsIo\FacebookMarketingApi\Tests\Factories;

use EolabsIo\FacebookMarketingApi\Tests\Factories\Contracts\FactoryInterface;

abstract class BaseFactory implements FactoryInterface
{
    public static function new(): self
    {
        return new static();
    }
}
