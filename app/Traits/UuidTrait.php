<?php

namespace App\Traits;

use Webpatser\Uuid\Uuid as UuidGenerator;

trait UuidTrait
{
    protected static function bootUuidTrait()
    {
        static::creating(function ($model) {
            $model->incrementing = false;
            $model->{$model->getKeyName()} = substr(UuidGenerator::generate()->string, 0, 12);
        });
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function getIncrementing()
    {
        return false;
    }
}
