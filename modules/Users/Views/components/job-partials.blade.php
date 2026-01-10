@if ($jobs->count())
    @foreach ($jobs as $job)
        <div class="card col-5 d-flex  m-3" style="border:0px;border-bottom: 4px solid black;">
            <div class="card-body position-relative">
                <div class="save-job position-absolute fs-4" style="right: 10px;">
                    @if ($job->is_saved)
                        <button class="btn toggle-save" data-job-id="{{ $job->id }}">
                            <i class="bi bi-bookmark-check-fill"></i>
                        </button>
                    @else
                        <button class="btn toggle-save" data-job-id="{{ $job->id }}">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    @endif
                </div>
                @if ($job->employer->avatar)
                    <img src="{{ asset('storage/' . $job->employer->avatar) }}" class="rounded-square" width="120"
                        height="120" alt="Avatar">
                @else
                    <img src="https://static.vecteezy.com/system/resources/previews/013/360/247/non_2x/default-avatar-photo-icon-social-media-profile-sign-symbol-vector.jpg"
                        class="rounded-circle" width="120" height="120">
                @endif

                <div class="job-title fw-bolder fs-3">{{ $job->title }}

                </div>
                <p style="color: gray;" class="card-text description-preview three-line-ellipsis"
                    style="cursor:pointer;">
                    {{ $job->description }}
                </p>

                <p style="color: gray;" class="card-text description-full d-none">
                    {{ $job->description }}
                </p>
                <div class="job-company pb-2 fs-5">
                    <i class="bi bi-building" style="color: gray;"></i> {{ $job->employer->company_name }}
                </div>
                {{-- <div class="job-location">{{ $job->location_id }}</div> --}}
                <div class="due date"><i class="bi bi-alarm" style="color: gray;"></i> {{ $job->ending_date }}</div>
                <div class="job info my-2">
                    <span style="background: rgba(105, 105, 105, 0.121);color: rgb(94, 94, 94);"
                        class="badge ">{{ $job->job_type }}</span>
                    <span style="background: rgba(100, 100, 100, 0.122);color: rgb(82, 82, 82);"
                        class="badge ">{{ $job->work_type }}</span>
                </div>
                <div class="buttons d-flex gap-1">
                    <a href="{{ route('application.form', $job->id) }}" class="btn btn-primary col-6">Apply
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    {{ $jobs->links() }}
@else
    <p class="text-muted">No jobs found.</p>
@endif
