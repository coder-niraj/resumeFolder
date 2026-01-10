<?php

namespace Modules\Jobs\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Jobs\DTOs\AddJobPostDTO;
use Modules\Jobs\DTOs\UpdateJobDTO;
use Modules\Jobs\Services\JobPostService;
use Modules\Users\Models\Resumes;
use Yajra\DataTables\DataTables;

class JobController extends Controller
{
    private $service;
    public function __construct(JobPostService $service)
    {
        $this->service = $service;
    }
    public function show(Request $request, $id)
    {

        $query = $this->service->getApplication($id);

        return response()->json([
            'html' => $query['cover_letter'],
        ]);
    }
    public function view(Resumes $resume)
    {

        return response()->file(
            Storage::disk('resumes')->path($resume->file_path),
            [
                'Content-Type' => $resume->mime_type ?? 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $resume->original_name . '"'
            ]
        );
    }
    function jobApplications(Request $request, $jobId)
    {
        $employeeObj = Auth::guard('employee')->user();

        $query = $this->service->getApplications($employeeObj->id, $jobId);
        // dd($query);
        return DataTables::of($query)
            ->addColumn('resume', function ($job) {
                $url = route('jobs.resume.view', $job->resume->id);
                return '
          <div class="w-100 d-flex justify-content-center ">
           <button
            type="button"
            data-url="' . $url . '"
            class="btn btn-sm btn-primary view-resume">
            <i class="bi bi-file-earmark-person-fill"></i>
         </button>
</div>
    ';
            })
            ->addColumn('status', function ($job) {
                $btnClass = match ($job->status) {
                    'pending'  => 'btn-warning',
                    'reviewed' => 'btn-info',
                    'accepted' => 'btn-success',
                    'rejected' => 'btn-danger',
                    default    => 'btn-secondary',
                };

                $url = route('jobs.applications', $job->id);
                return '
                  <button type="button " id="status-btn-' . $job->id . '" class="btn  ' . $btnClass . ' dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    ' . $job->status . '
                  </button>
                  <ul class="dropdown-menu">
                    <li class="changeStatus"  data-id="' . $job->id . '" data-status="pending"><a class="dropdown-item" href="#">pending</a></li>
                    <li class="changeStatus"  data-id="' . $job->id . '" data-status="reviewed"><a class="dropdown-item" href="#">reviewed</a></li>
                    <li class="changeStatus"  data-id="' . $job->id . '" data-status="accepted"><a class="dropdown-item" href="#">accepted</a></li>
                    <li class="changeStatus"  data-id="' . $job->id . '" data-status="rejected"><a class="dropdown-item" href="#">rejected</a></li>
                  </ul>
                ';
            })
            ->addColumn('cover_letter', function ($job) {

                return '
          <div class="form-switch d-flex justify-center">
            <button
            type="button "
             data-id="' . $job->id . '"
                class="btn btn-sm btn-secondary view_cover_letter">
                <i class="bi bi-envelope-fill"></i>
             </button>
            </div>
    ';
            })
            ->addColumn('feedback', function ($job) {

                $url = route('jobs.applications', $job->id);
                return '
                <div class="form-switch d-flex justify-center">
                    <a href="' . $url . '"
                    type="button"
                    class="btn btn-sm btn-light  " style="border:2px solid gray;color:gray;">
                        <i class="bi bi-chat-dots-fill"></i>
                    </a>
                </div>
    ';
            })
            ->rawColumns(['resume', 'cover_letter', 'feedback', 'status'])
            ->make(true);
    }

    public function jobApplicationsListView(Request $request, $jobId)
    {
        return view('jobs::jobs.job-application', ['jobId' => $jobId]);
    }
    public function jobList()
    {
        $employeeObj = Auth::guard('employee')->user();

        $query = $this->service->getJobs($employeeObj->id);
        return DataTables::of($query)->addColumn('active', function ($job) {
            return $job->active ? '
           <div class="form-switch">
            <input
                class="form-check-input blocked-toggle"
                type="checkbox"
                data-id="' . $job->id . '"
                id="' . $job->id . '"
                name="active"
                checked
            >
        </div>
        ' : '
         <div class="form-switch">
            <input
                class="form-check-input blocked-toggle"
                type="checkbox"
                data-id="' . $job->id . '"
                id="' . $job->id . '"
                name="active"
            >
        </div>';
        })->addColumn('action', function ($job) {
            $urlUpdate = route('jobs.update', $job->id);
            return '
        <div class="form-switch">
            <a href="' . $urlUpdate . '" class="btn btn-sm btn-success ">
               <i class="bi bi-pencil-square"></i>
            </a>
            <button   data-id="' . $job->id . '" class="btn btn-sm btn-danger  delete-button">
              <i class="bi bi-archive-fill"></i>
            </button>
        </div>
    ';
        })->addColumn('info', function ($job) {

            $url = route('jobs.application.view', $job->id);
            return '
          <div class="form-switch d-flex justify-center">
           <a href="' . $url . '"
            type="button"
            class="btn btn-sm btn-dark">
            <i class="bi bi-three-dots-vertical"></i>
         </a>
</div>
    ';
        })
            ->rawColumns(['active', 'action', 'info'])
            ->make(true);
    }
    public function jobPostListView()
    {
        return view('jobs::jobs.job-list');
    }
    public function jobPostFromView()
    {
        $getSkills = $this->service->getJobSkills();
        $employeeObj = Auth::guard('employee')->user();
        return view('jobs::jobs.job-add', [
            'skills' => $getSkills,
            'employeeObj' => $employeeObj,
        ]);
    }
    public function jobPostUpdateFromView(Request $request, $id)
    {
        $getSkills = $this->service->getJobSkills();
        $employeeObj = Auth::guard('employee')->user();

        $jobObj = $this->service->getJob($id);
        return view('jobs::jobs.job-update', [
            'skills' => $getSkills,
            'jobObj' => $jobObj,
            'employeeObj' => $employeeObj,
        ]);
    }
    public function createJobPost(JobPostRequest $request)
    {
        $validated = $request->validated();
        $this->service->addJobPost(
            new AddJobPostDTO(
                $validated['employer_id'],
                $validated['location_id'],
                $validated['title'],
                $validated['description'],
                $validated['skills'],
                $validated['experience'],
                $validated['job_type'],
                $validated['job_time'],
                $validated['work_type'],
                $validated['salary_min'] ?? null,
                $validated['salary_max'] ?? null,
                $validated['education'] ?? null,
                $validated['ending_date'] ?? null,
            )
        );
        return back()->with("success", "job post added successful");
    }
    public function updateJobForm(JobPostUpdateRequest $request)
    {
        $validated = $request->validated();
        $id = $request['id'];
        $this->service->updateJobPost(
            new UpdateJobDTO(
                $validated['employer_id'],
                $validated['location_id'],
                $validated['title'],
                $validated['description'],
                $validated['skills'],
                $validated['experience'],
                $validated['job_type'],
                $validated['job_time'],
                $validated['work_type'],
                $validated['salary_min'] ?? null,
                $validated['salary_max'] ?? null,
                $validated['education'] ?? null,
                $validated['ending_date'] ?? null,
            ),
            $id
        );
        return back()->with("success", "job post updated successful");
    }
    public function deleteJob(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $this->service->deleteJob($request['id']);
        return response()->json(['message' => 'delete successfully ' . $request['id']]);
    }
    public function toggleActiveJobPost(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $this->service->toggleActiveJob($request['id']);
        return response()->json(['message' => 'delete successfully ' . $request['id']]);
    }
    public function changeApplicationStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required|in:pending,reviewed,accepted,rejected',
        ]);

        $this->service->changeApplicationStatus($request['id'], $request['status']);
        return response()->json(['message' => $request['id'], 'status' => $request['status']]);
    }
}
