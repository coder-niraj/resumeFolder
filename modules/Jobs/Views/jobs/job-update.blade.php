@extends('jobs::layouts.app')
@section('title', 'employee')
@section('header')
@endsection
@section('style')
@endsection
@section('content')
    <div class="d-flex">
        <div class="">
            @include('jobs::components.sidebar', ['active' => 'nothing'])
        </div>
        <div class="w-100 input-bg">
            <div class="m-3 bg-white">
                <form action="{{ route('jobs.update.form') }}" method="POST">
                    @csrf
                    <div class="container" style="height: 95vh;border-radius: 5px;border-top: 5px solid black;">
                        <div class="row title my-3">
                            <h2>
                                Job Update Form
                            </h2>
                        </div>
                        <div class="form row">
                            <div class="col-6">
                                <input type="text" class="form-control input-bg " hidden value={{ $jobObj->id }}
                                    name="id">
                                <label for="validationCustom01" class="form-label">Title</label>
                                <input type="text" class="form-control input-bg " value="{{ $employeeObj->id }}" hidden
                                    name="employer_id">
                                @error('employer_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control input-bg "
                                    value="c1ccc2e2-eafe-11f0-89fe-94de80948ccc" hidden name="location_id">
                                @error('location_id ')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control input-bg " value="{{ $jobObj->title }}"
                                    name="title">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="col-6">
                                <label for="validationCustom01" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="">{{ $jobObj->description }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="col-6">
                                <label class="form-label">Skills</label>
                                <select id="skills" name="skills[]" multiple></select>
                                <div id="skillsTags" class="mt-2"></div>
                                @error('skills')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="col-6 d-flex align-items-center gap-2">

                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">
                                        experience
                                        <span style="color: rgb(155, 153, 153);">
                                            (in Years)
                                        </span>
                                    </label>
                                    <input type="text" class="form-control input-bg " value="{{ $jobObj->experience }}"
                                        name="experience">
                                    @error('experience')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">education</label>
                                    <input type="text" class="form-control input-bg " value="{{ $jobObj->education }}"
                                        name="education">
                                    @error('education')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center gap-2">
                                <div class="col-6">
                                    <select name="job_type" class="form-select custom-select-lg mb-3">
                                        <option selected>job_type</option>
                                        <option value="full-time"
                                            {{ $jobObj->job_type === 'full-time' ? 'selected' : '' }}>
                                            full-time</option>
                                        <option value="part-time"
                                            {{ $jobObj->job_type === 'part-time' ? 'selected' : '' }}>
                                            part-time</option>
                                        <option value="contract" {{ $jobObj->job_type === 'contract' ? 'selected' : '' }}>
                                            contract</option>
                                        <option value="internship"
                                            {{ $jobObj->job_type === 'internship' ? 'selected' : '' }}>internship</option>
                                        <option value="temporary"
                                            {{ $jobObj->job_type === 'temporary' ? 'selected' : '' }}>
                                            temporary</option>
                                    </select>
                                    @error('job_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <select name="job_time" class="form-select custom-select-lg mb-3">
                                        <option selected>job_time</option>
                                        <option value="day" {{ $jobObj->job_time === 'day' ? 'selected' : '' }}>day
                                        </option>
                                        <option value="night" {{ $jobObj->job_time === 'night' ? 'selected' : '' }}>night
                                        </option>
                                        <option value="flexible" {{ $jobObj->job_time === 'flexible' ? 'selected' : '' }}>
                                            flexible</option>
                                    </select>
                                    @error('job_time')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>



                            <div class="col-6 d-flex align-items-center gap-2">
                                <div class="col-6" style="height: fit-content;">
                                    <label for="validationCustom01" class="form-label">salary_min
                                        <span style="color: rgb(155, 153, 153);">
                                            (in LPA)
                                        </span>
                                    </label>
                                    <input type="text" class="form-control input-bg " value="{{ $jobObj->salary_min }}"
                                        name="salary_min">
                                    @error('salary_min')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">salary_max
                                        <span style="color: rgb(155, 153, 153);">
                                            (in LPA)
                                        </span>
                                    </label>
                                    <input type="text" class="form-control input-bg " value="{{ $jobObj->salary_max }}"
                                        name="salary_max">
                                    @error('salary_max')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-6 d-flex align-items-center gap-2">
                                <div class="col-6">
                                    <select name="work_type" class="form-select custom-select-lg ">
                                        <option selected>work_type</option>
                                        <option value="remote" {{ $jobObj->work_type === 'remote' ? 'selected' : '' }}>
                                            remote</option>
                                        <option value="on-site" {{ $jobObj->work_type === 'on-site' ? 'selected' : '' }}>
                                            on-site</option>
                                        <option value="hybrid" {{ $jobObj->work_type === 'hybrid' ? 'selected' : '' }}>
                                            hybrid</option>
                                    </select>
                                    @error('work_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <input type="date" placeholder="end date" class="form-control input-bg "
                                        name="ending_date" value="{{ $jobObj->ending_date }}">
                                    @error('ending_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-4">
                            <button class="btn btn-dark w-100">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        const allSkills = @json(
            $skills->map(fn($s) => [
                    'value' => $s->skills,
                    'text' => $s->skills,
                ]));
        const selectedSkills = @json($jobObj->skills ?? []);
        new TomSelect('#skills', {
            options: allSkills,
            items: selectedSkills,
            create: true,
            plugins: ['remove_button'],
            placeholder: 'Type skill and press enter'
        });
    </script>
@endsection
