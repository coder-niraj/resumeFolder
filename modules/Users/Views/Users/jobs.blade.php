@extends('user::layouts.app')
@section('title', 'employee')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
@endsection
@section('content')
    <div class="d-flex">
        <div class="">
            @include('user::components.sidebar', ['active' => 'jobs'])
        </div>
        <div class="w-100 input-bg">
            <div class="m-3 bg-white">
                <div class="container " style="height: 95vh;border-radius: 5px;border-top: 5px solid black;">
                    <form id="jobSearchForm">
                        <div class="head d-flex py-2 px-3">


                            <div class="filter col-8 d-flex gap-2" style="height: 40px;">
                                <div>
                                    <select name="job_type" class="form-select col-3 custom-select-lg mb-3">
                                        <option selected selected value="{{ null }}">select job type</option>
                                        <option value="full-time">full-time</option>
                                        <option value="part-time">part-time</option>
                                        <option value="contract">contract</option>
                                        <option value="internship">internship</option>
                                        <option value="temporary">temporary</option>
                                    </select>
                                </div>
                                <div>
                                    <select name="job_time" class="form-select custom-select-lg col-3 mb-3">
                                        <option selected value="{{ null }}">select job time</option>
                                        <option value="day">day</option>
                                        <option value="night">night</option>
                                        <option value="flexible">flexible</option>
                                    </select>
                                </div>
                                <div>
                                    <select name="work_type" class="form-select custom-select-lg col-3 mb-3">
                                        <option selected value="{{ null }}">select work type</option>
                                        <option value="remote">remote</option>
                                        <option value="on-site">on-site</option>
                                        <option value="hybrid">hybrid</option>
                                    </select>
                                </div>
                                <div>
                                    <select name="location" class="form-select custom-select-lg col-3 mb-3">
                                        <option selected value="{{ null }}">select location</option>
                                        <option value="full-time">full-time</option>
                                        <option value="part-time">part-time</option>
                                        <option value="contract">contract</option>
                                        <option value="internship">internship</option>
                                        <option value="temporary">temporary</option>
                                    </select>
                                </div>
                            </div>
                            <div class="search col-4 d-flex">
                                <div class="input-group col-4">
                                    <span class="input-group-text fs-5" style="background: #212529;color:white;"
                                        id="basic-addon1">&#8981</span>
                                    <input type="text" name="search" id="searchInput" class="form-control search-bar"
                                        style="border:0px;background: #f3f6fa" placeholder="Search here..."
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                {{-- <button class="btn btn-secondary">search</button> --}}
                            </div>
                        </div>
                    </form>
                    <div class="body col-12 row "
                        style="height: 85vh; overflow-y: scroll;background: rgba(187, 187, 187, 0.255);" id="jobResults">
                        @include('user::components.job-partials', ['jobs' => $jobs])
                    </div>
                    <div class="pagination">
                        {{ $jobs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script defer>
        document.querySelectorAll('.description-preview').forEach(el => {
            el.addEventListener('click', () => {
                el.classList.add('d-none'); // hide preview
                el.nextElementSibling.classList.remove('d-none'); // show full desc
            });
        });
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.toggle-save').forEach(button => {
                button.addEventListener('click', function() {
                    const jobId = this.dataset.jobId;
                    const icon = this.querySelector('i');

                    fetch(`/user/toggle-save-job/${jobId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document
                                    .querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.saved) {
                                icon.classList.replace('bi-bookmark', 'bi-bookmark-check-fill');
                            } else {
                                icon.classList.replace('bi-bookmark-check-fill', 'bi-bookmark');
                            }
                        });
                });
            });

            const form = document.getElementById('jobSearchForm');
            const searchInput = document.getElementById('searchInput');

            function fetchJobs() {
                const params = new URLSearchParams(new FormData(form)).toString();

                fetch(`{{ route('user.jobs') }}?${params}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('jobResults').innerHTML = html;
                        window.history.pushState({}, '', `?${params}`);
                    })
                    .catch(err => console.error(err));
            }
            form.querySelectorAll('select').forEach(select => {
                select.addEventListener('change', function() {

                    fetchJobs();

                });
            });
            searchInput.addEventListener('input', function() {
                setTimeout(() => {
                    fetchJobs();
                }, 800);

            });
        })
    </script>
    <script>
        document.addEventListener('click', function(e) {
            if (e.target.closest('.pagination a')) {
                e.preventDefault();

                fetch(e.target.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('jobResults').innerHTML = html;
                        window.history.pushState({}, '', e.target.href);
                    });
            }
        });
    </script>
@endsection
