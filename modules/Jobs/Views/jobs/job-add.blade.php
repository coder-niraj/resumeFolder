@extends('jobs::layouts.app')
@section('title', 'employee')
@section('header')
@endsection
@section('style')
@endsection
@section('content')
    <div class="d-flex">
        <div class="">
            @include('jobs::components.sidebar', ['active' => 'job-post'])
        </div>
        <div class="w-100 input-bg">
            <div class="m-3 bg-white">
                <form action="{{ route('jobs.create') }}" method="POST">
                    @csrf
                    <div class="container" style="height: 95vh;border-radius: 5px;border-top: 5px solid black;">
                        <div class="row title my-3">
                            <h2>
                                Job Post Form
                            </h2>
                        </div>
                        <div class="form row">
                            <div class="col-6">
                                <label for="validationCustom01" class="form-label">Title</label>
                                <input type="text" class="form-control input-bg " value="{{ $employeeObj->id }}" hidden
                                    name="employer_id">
                                @error('employer_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control " value="c1ccc2e2-eafe-11f0-89fe-94de80948ccc"
                                    hidden name="location_id">
                                @error('location_id ')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" placeholder="Enter job title" class="form-control " name="title">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="col-6">
                                <label for="validationCustom01" class="form-label">Description</label>
                                <textarea name="description" class="form-control" placeholder="Enter job description" id=""></textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>



                            <div class="col-6">
                                <div class="col-12 ">
                                    <label class="form-label">Skills</label>
                                    <select id="skills" name="skills[]" multiple></select>
                                    <div id="skillsTags" class="mt-2"></div>
                                    @error('skills')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 py-3">
                                    <label class="form-label">Job Type</label>
                                    <div class="col-12 d-flex align-items-center gap-2 ">
                                        <div class="col-12">
                                            <select name="job_type" class="form-select custom-select-lg mb-3">
                                                <option selected>select job type</option>
                                                <option value="full-time">full-time</option>
                                                <option value="part-time">part-time</option>
                                                <option value="contract">contract</option>
                                                <option value="internship">internship</option>
                                                <option value="temporary">temporary</option>
                                            </select>
                                            @error('job_type')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <select name="job_time" class="form-select custom-select-lg mb-3">
                                                <option selected>select job time</option>
                                                <option value="day">day</option>
                                                <option value="night">night</option>
                                                <option value="flexible">flexible</option>
                                            </select>
                                            @error('job_time')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-6 align-items-center ">

                                <div class="col-12 py-2">
                                    <label for="validationCustom01" class="form-label">
                                        experience
                                        <span style="color: rgb(155, 153, 153);">
                                            (in Years)
                                        </span>
                                    </label>
                                    <input type="text" placeholder="Enter experience Requirements" class="form-control "
                                        name="experience">
                                    @error('experience')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="col-12 py-2">
                                    <label for="validationCustom01" class="form-label">education</label>
                                    <input type="text" class="form-control " placeholder="Enter education requirements"
                                        name="education">
                                    @error('education')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>





                            <div class="col-6 d-flex align-items-center gap-2">
                                <div class="col-6" style="height: fit-content;">
                                    <label for="validationCustom01" class="form-label">Minimum Salary
                                        <span style="color: rgb(155, 153, 153);">
                                            (in LPA)
                                        </span>
                                    </label>
                                    <input type="text" class="form-control " placeholder="Enter min salary"
                                        name="salary_min">
                                    @error('salary_min')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">Maximum Salary
                                        <span style="color: rgb(155, 153, 153);">
                                            (in LPA)
                                        </span>
                                    </label>
                                    <input type="text" placeholder="Enter max salary" class="form-control "
                                        name="salary_max">
                                    @error('salary_max')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-6 d-flex align-items-center gap-2">
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">Work Type
                                    </label>
                                    <select name="work_type" class="form-select custom-select-lg ">
                                        <option selected>Select work type</option>
                                        <option value="remote">remote</option>
                                        <option value="on-site">on-site</option>
                                        <option value="hybrid">hybrid</option>
                                    </select>
                                    @error('work_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">Application Deadline
                                    </label>
                                    <input type="date" placeholder="end date" class="form-control "
                                        name="ending_date">
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
        new TomSelect('#skills', {
            options: @json($skills->map(fn($s) => ['value' => $s->skills, 'text' => $s->skills])),
            create: true,
            plugins: ['remove_button'],
            placeholder: 'Type skill and press enter'
        });
    </script>
    </script>
    <script>
        const input = document.getElementById('skillsInput');
        const tagsDiv = document.getElementById('skillsTags');
        const hidden = document.getElementById('skillsHidden');

        let skills = [];

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && input.value.trim() !== '') {
                e.preventDefault();
                const skill = input.value.trim();

                if (!skills.includes(skill)) {
                    skills.push(skill);
                    render();
                }
                input.value = '';
            }
        });

        function render() {
            tagsDiv.innerHTML = '';
            skills.forEach((skill, index) => {
                const badge = document.createElement('span');
                badge.className = 'badge bg-primary me-2 mb-2';
                badge.innerHTML = `${skill}
                <span style="cursor:pointer" onclick="removeSkill(${index})">&times;</span>`;
                tagsDiv.appendChild(badge);
            });
            hidden.value = JSON.stringify(skills);
        }

        function removeSkill(index) {
            skills.splice(index, 1);
            render();
        }
    </script>
@endsection
{{-- 
            
            string('title')
            text('description')
            json('skills')
            text('experience')
            uuid('location_id')->nullable();   
            enum('work_type', ['remote', 'on-site', 'hybrid'])
            boolean('active')->default(true)
            unsignedInteger('applications_count')->default(0)
            enum('job_type', ['full-time', 'part-time', 'contract', 'internship', 'temporary'])
            enum('job_time', ['day', 'night', 'flexible'])
            decimal('salary_min')->nullable()
            decimal('salary_max')->nullable()
            string('education')->nullable()
            date('ending_date')->nullable()
            timestamp('posted_at')->nullable() 
            --}}
