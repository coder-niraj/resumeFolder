<?php

namespace Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Jobs\Models\Jobs;
use Modules\Users\DTOs\JobSearchDTO;
use Modules\Users\DTOs\UserProfileDTO;
use Modules\Users\Services\UserServices;


class UserController extends Controller
{
    private $service;
    function __construct(UserServices $service)
    {
        $this->service = $service;
    }
    function profileView(Request $request)
    {
        $userObj = Auth::guard('web')->user();
        return view('user::Users.profile', compact('userObj'));
    }
    function jobsView(Request $request)
    {
        $userObj = Auth::guard('web')->user();
        return view('user::Users.jobs', compact('userObj'));
    }
    function applicationListView(Request $request)
    {
        $userObj = Auth::guard('web')->user();
        return view('user::Users.application-list', compact('userObj'));
    }
    function dashboardView(Request $request)
    {
        $userObj = Auth::guard('web')->user();
        return view('user::Users.dashboard', compact('userObj'));
    }
    function applicationView(Request $request)
    {
        $userObj = Auth::guard('web')->user();
        return view('user::Users.dashboard', compact('userObj'));
    }
    function passwordChangeView(Request $request)
    {
        $userObj = Auth::guard('web')->user();
        return view('user::Users.password-change', compact('userObj'));
    }
    function savedJobsView(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $jobs = Jobs::whereHas('savedByUsers', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->with('employer') // optional
            ->latest()
            ->paginate(10);

        if ($request->ajax()) {

            $jobs = $this->service->jobSearchService(new JobSearchDTO(
                $request['job_type'] ?? null,
                $request['job_time'] ?? null,
                $request['work_type'] ?? null,
                $request['search'] ?? null,
            ), Auth::guard('web')->user()->id);

            return view('user::Users.saved-jobs', compact('jobs'));
        }
        return view('user::Users.saved-jobs', compact('jobs'));
    }
    function jobSearch(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $jobs = Jobs::where('active', true)->withExists([
            'savedByUsers as is_saved' => function ($q) use ($userId) {
                $q->where('user_id', $userId);
            }
        ])->paginate(10);

        if ($request->ajax()) {

            $jobs = $this->service->jobSearchService(new JobSearchDTO(
                $request['job_type'] ?? null,
                $request['job_time'] ?? null,
                $request['work_type'] ?? null,
                $request['search'] ?? null,
            ), Auth::guard('web')->user()->id);
            return view('user::components.job-partials', compact('jobs'))->render();
        }

        // Normal request → full page
        return view('user::Users.jobs', compact('jobs'));
    }
    function profileUpdate(ProfileUpdateRequest $request)
    {
        $validated = $request->validated();
        $this->service->updateProfile(
            new UserProfileDTO(
                $validated['email'],
                $validated['firstname'],
                $validated['lastname'],
                $validated['phone'] ?? null,
                $validated['avatar'] ?? null
            )
        );
        return back()->with("success", "profile updated");
    }
    function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (!Hash::check($request->current_password, auth()->guard('web')->user()->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect',
            ]);
        }
        $this->service->passowrdChange(auth()->guard('web')->user()->email, $request['password']);
        return back()->with("success", "password updated");
    }
    public function toggleSavedJob(Request $request, $jobId)
    {
        $user = Auth::guard('web')->user();
        $saved = $this->service->toggleSaveJobService($user, $jobId);
        return response()->json(['saved' => $saved]);
    }
    public function toggleSavedJobGet(Request $request, $jobId)
    {
        return $jobId;
        // $user = Auth::guard('web')->user();
        // $this->service->toggleSaveJobService($user, $jobId);
    }
}
