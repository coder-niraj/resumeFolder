<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Applications\Models\JobApplications;
use Modules\Jobs\Models\Jobs;

class SavedJobs extends Model
{
    protected $table = 'saved_jobs';
    protected $fillable = [
        'user_id',
        'job_id',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job()
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }
}
