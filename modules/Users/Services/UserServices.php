<?php

namespace Modules\Users\Services;

use Modules\Users\DTOs\JobSearchDTO;
use Modules\Users\DTOs\UserProfileDTO;
use Modules\Users\Repositories\UserEloquent;

class UserServices
{
    public $userRepo;
    public function __construct(UserEloquent $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function jobSearchService(JobSearchDTO $jobDTO, $userId)
    {
        return $this->userRepo->searchJobs($userId, $jobDTO->search, null, $jobDTO->job_type, $jobDTO->job_time, $jobDTO->work_type);
    }
    public function updateProfile(UserProfileDTO $profileDTO)
    {
        if ($profileDTO->avatar) {
            $avatarPath = $profileDTO->avatar->store(
                'avatars',
                'public'
            );
        }
        $this->userRepo->updateUser(
            $profileDTO->email,
            [
                "firstname" => $profileDTO->first_name,
                "lastname" => $profileDTO->last_name,
                "phone" => $profileDTO->phone ?? null,
                "avatar" => $avatarPath ?? null,
            ]
        );
    }
    public function passowrdChange($email, $password)
    {
        $this->userRepo->userChangePassword($email, $password);
    }
    public function toggleSaveJobService($user, $jobId)
    {
        return $this->userRepo->toggleSavedJob($user, $jobId);
    }
}
