<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resumes extends Model
{
      protected $fillable = [
        'user_id',
        'file_path',
        'parsed_data',
        'experience_years',
        'education',
        'summary'
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
