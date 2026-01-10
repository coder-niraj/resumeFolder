<?php

namespace Modules\Applications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Jobs\Models\Jobs;
use Modules\Users\Models\Resumes;
use Modules\Users\Models\User;

class JobApplications extends Model
{
    protected $fillable = [
        'user_id',
        'job_posting_id',
        'resume_id',
        'status',
        'cover_letter',
        'expected_ctc',
        'applied_at',
        'reviewed_at',
        'feedback'
    ];
    public $incrementing = false;      // disable auto increment
    protected $keyType = 'string';     // key type is string (UUID)

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job()
    {
        return $this->belongsTo(Jobs::class, 'job_posting_id');
    }

    public function resume()
    {
        return $this->belongsTo(Resumes::class, 'resume_id');
    }

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
