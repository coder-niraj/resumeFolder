@extends('admin::layouts.app')
@section('title', 'admin-login')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')

@endsection
@section('content')
    <div class="d-flex">
        <div class="">
            @include('jobs::components.sidebar', ['active' => 'jobs'])
        </div>
        <div class="w-100 input-bg" style="overflow: hidden;">
            <div class="m-3 bg-white p-3" style="border-top: 5px solid black;">
                <div class="container pt-4" style="border-radius: 5px;">
                    <table id="jobs-table" class=" user-table ">
                        <thead class="user-table-head">
                            <tr class="user-table-head-row">
                                <th>title</th>
                                <th>description</th>
                                <th>experience</th>
                                <th>job_type</th>
                                <th>ending_date</th>
                                <th>status</th>
                                <th>action</th>
                                <th>info</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script>
        function connectTable() {

        }
        $(document).ready(function() {
            $('#jobs-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                initComplete: function() {
                    var $searchInput = $('div.dataTables_filter input');
                    $searchInput.attr('placeholder', 'Search a Job Post');
                    $searchInput.addClass('form-control'); // For Bootstrap style input if needed
                },
                scrollCollapse: true,
                ajax: "{{ route('jobs.list') }}",
                stripeClasses: ['dt-row-odd', 'dt-row-even'],
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },


                    {
                        data: 'experience',
                        name: 'experience'
                    },

                    {
                        data: 'job_type',
                        name: 'job_type'
                    },

                    {
                        data: 'ending_date',
                        name: 'ending_date'
                    },
                    {
                        data: 'active',
                        name: 'active'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'info',
                        name: 'info'
                    },
                ]
            });
        });
        $('#jobs-table').on('draw.dt', function() {
            $('.blocked-toggle').off('change').on('change', function() {
                var id = $(this).data('id');
                const baseUrl = window.location.origin;

                toggleActiveJob(id, baseUrl);
            });
            $(document).on('click', '.delete-button', function() {
                const jobId = $(this).data('id');
                const baseUrl = window.location.origin;
                console.log('Job ID:', jobId);
                console.log('Base URL:', baseUrl);
                deletePost(jobId, baseUrl);
            });
        });

        function toggleActiveJob(id, baseUrl) {
            console.log('Toggled checkbox for user email:', id);
            console.log('Base URL:', baseUrl);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(baseUrl + '/jobs/post/toggle', {
                method: 'POST', // or 'PUT', 'DELETE', etc.
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    // your data here
                    id
                })
            }).then(async res => {
                let obj = await res.json();
                console.log(obj);

            }).catch(Err => {
                console.log("error occured")
            })
        }


        function deletePost(id, baseUrl) {

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(baseUrl + '/jobs/post/delete', {
                method: 'POST', // or 'PUT', 'DELETE', etc.
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    // your data here
                    id
                })
            }).then(async res => {
                let obj = await res.json();
                console.log(obj);
                window.location.reload();
            }).catch(Err => {
                console.log("error occured")
            })
        }
    </script>
@endsection
