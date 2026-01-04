<?php

namespace Modules\Applications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobApplications extends Model
{
     protected $fillable = [
        'user_id',
        'job_posting_id',
        'resume_id',
        'status',
        'cover_letter',
        'applied_at',
        'reviewed_at',
        'feedback'
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
