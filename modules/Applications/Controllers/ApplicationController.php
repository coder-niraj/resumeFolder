<?php

namespace Modules\Applications\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Applications\DTOs\CreateApplicationDTO;
use Modules\Applications\Services\ApplicationServices;
use Modules\Users\Models\Resumes;
use Yajra\DataTables\DataTables;

class ApplicationController extends Controller
{
    private $service;
    public function __construct(ApplicationServices $service)
    {
        $this->service = $service;
    }

    public function show(Request $request, $id)
    {
        $userObj = Auth::guard('web')->user();
        $query = $this->service->getApplicationList($userObj->id);
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
    public function applicationFormView(Request $request, $jobId)
    {
        $userObj = Auth::guard('web')->user();

        return view('application::Home.application-form', [
            'userObj' => $userObj,
            'jobId' => $jobId
        ]);
    }
    public function applicationEditFormView()
    {
        return view('application::Home.application-edit-form');
    }
    public function applicationListView()
    {
        $userObj = Auth::guard('web')->user();
        // $data = $this->service->getApplicationList($userObj->id);
        return view('application::Home.application-list');
    }
    public function applicationLists()
    {
        $userObj = Auth::guard('web')->user();
        $query = $this->service->getApplicationList($userObj->id);
        return DataTables::of($query)
            ->addColumn('status', function ($job) {
                $btnClass = match ($job->status) {
                    'pending'  => 'btn-warning',
                    'reviewed' => 'btn-info',
                    'accepted' => 'btn-success',
                    'rejected' => 'btn-danger',
                    default    => 'btn-secondary',
                };
                return '
          <div class="w-100 d-flex justify-content-center ">
           <button
            type="button"
            class="btn btn-sm ' . $btnClass . ' view-resume" disabled>
           ' . $job->status . '
         </button>
</div>
    ';
            })
            ->addColumn('resume', function ($job) {
                $url = route('application.resume.view', $job->resume->id);
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
            })->rawColumns(['resume', 'cover_letter', 'status'])
            ->make(true);
    }
    public function createApplication(ApplicationCreateRequest $request)
    {
        $userObj = Auth::guard('web')->user();
        $validated = $request->validated();
        $application = $this->service->createApplicationService(new CreateApplicationDTO(
            $validated['user_id'],
            $validated['job_posting_id'],
            $validated['cover_letter'],
            $validated['expected_ctc'],
            $validated['resume'],
        ), $userObj->id);
        if ($application) {

            return back()->with("success", "application submitted");
        } else {
            return back()->with("error", "already applied");
        }
    }
}
