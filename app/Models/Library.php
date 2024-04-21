<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Library extends Model
{
    use SoftDeletes;

    protected static function booted(): void
    {
        static::creating(function (Library $library) {
            $library->uuid = Uuid::uuid4()->toString();
        });
    }
}
