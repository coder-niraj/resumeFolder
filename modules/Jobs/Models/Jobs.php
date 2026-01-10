<?php

namespace Modules\Jobs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Applications\Models\JobApplications;
use Modules\Employers\Models\Employees;
use Modules\Users\Models\User;

class Jobs extends Model
{
    protected $table = 'job_postings';
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
    protected $casts = [
        'skills' => 'array',
    ];
    public function employer()
    {
        return $this->belongsTo(
            Employees::class,
            'employer_id'
        );
    }
    public function applications()
    {
        return $this->hasMany(
            JobApplications::class,
            'job_posting_id'
        );
    }
    public function savedByUsers()
    {
        return $this->belongsToMany(
            User::class,
            'saved_jobs',
            'job_id',
            'user_id'
        )->withTimestamps();
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
