<?php

namespace Modules\Employers\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Employers extends Authenticatable
{
     protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'company_name',
        'company_website',
        'phone_number',
        'phone_number',
        'address',
        'status',
        'avatar'
    ];
    public $incrementing = false;      // disable auto increment
    protected $keyType = 'string';     // key type is string (UUID)

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                // Generate UUID when creating model
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
