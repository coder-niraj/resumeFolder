<?php

namespace Modules\Jobs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jobs extends Model
{
     protected $fillable = [
        'employer_id',
        'title',
        'description',
        'skills',
        'experience',
        'location_id',
        'work_type',
        'active',
        'applications_count',
        'job_type',
        'job_time',
        'salary_min',
        'salary_max',
        'education',
        'ending_date',
        'posted_at',
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
