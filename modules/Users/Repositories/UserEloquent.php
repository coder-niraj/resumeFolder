<?php

namespace Modules\Users\Repositories;

use Illuminate\Support\Facades\Hash;
use Modules\Jobs\Models\Jobs;
use Modules\Users\Models\User;

class UserEloquent implements UserRepository
{
    function getUser($email)
    {
        return User::where("email", $email)->first();
    }
    function userChangePassword($email, $password)
    {
        return User::where("email", $email)->update([
            'password' => Hash::make($password),
        ]);
    }
    function toggleSavedJob($user, $jobId)
    {
        if ($user->savedJobs()->where('job_id', $jobId)->exists()) {
            // Unsave
            $user->savedJobs()->detach($jobId);
            return false;
        } else {
            // Save
            $user->savedJobs()->attach($jobId);
            return true;
        }
    }
    function addUser(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'],
            'email'     => $data['email'],
            'password'  => $data['password'],
            'phone'     => $data['phone'] ?? null,
            'avatar'    => $data['avatar'] ?? null,
        ]);
    }
    function updateUser($email, $data)
    {
        $allowed = ['firstname', 'lastname', 'phone', 'avatar'];
        $updateData = [];
        foreach ($allowed as $field) {
            if (array_key_exists($field, $data)) {
                $updateData[$field] = $data[$field];
            }
        }
        $updateData = array_filter($updateData, function ($value) {
            return !is_null($value) && $value !== '';
        });

        return User::where("email", $email)->update($updateData);
    }
    function searchJobs($userId, $subject, $location, $jobType, $jobTime, $workType)
    {
        $query = Jobs::with(['employer']);
        $q = $subject;
        $query->where('active', true)->where(function ($sub) use ($q) {
            $sub->where('title', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%")
                ->orWhereJsonContains('skills', $q);
        })->withExists([
            'savedByUsers as is_saved' => function ($q) use ($userId) {
                $q->where('user_id', $userId);
            }
        ]);
        // if ($location) {
        //     $query->where('location', $location);
        // }

        if ($jobType) {
            $query->where('job_type', $jobType);
        }
        if ($jobTime) {
            $query->where('job_time', $jobTime);
        }
        if ($workType) {
            $query->where('work_type', $workType);
        }
        $jobs = $query->latest()->paginate(10);
        return $jobs;
    }
}
