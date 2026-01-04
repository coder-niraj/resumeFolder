<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    public $incrementing = false;      // disable auto increment
    protected $keyType = 'string';     // key type is string (UUID)
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'avatar'
    ];

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
