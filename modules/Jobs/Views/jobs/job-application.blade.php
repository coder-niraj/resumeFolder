@extends('jobs::layouts.app')
@section('title', 'employee')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
@endsection
@section('content')
    @include('jobs::components.pdf-view-modal')
    @include('jobs::components.cover-letter-view-modal')
    <div class="d-flex">
        <div class="">
            @include('jobs::components.sidebar', ['active' => 'jobs'])
        </div>
        <div class="w-100 input-bg">
            <div class="m-3 bg-white">
                <div class="container" style="height: 95vh;border-radius: 5px;border-top: 5px solid black;">

                    <table id="applicatiion-table" class=" user-table ">
                        <thead class="user-table-head">
                            <tr class="user-table-head-row">
                                <th>email</th>
                                <th>experience</th>
                                <th>resume</th>
                                <th>applied at</th>
                                <th>cover latter</th>
                                <th>expected ctc</th>
                                <th>feedback</th>
                                <th>status</th>
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
        $(document).on('click', '.view-resume', function() {
            const pdfUrl = $(this).data('url');
            console.log("show", pdfUrl);
            $('#resumeFrame').attr('src', pdfUrl);
            $('#resumeModal').modal('show');
        });
        $(document).on('click', '.changeStatus', function() {
            const coverViewRouteTemplate = "{{ route('jobs.update-status') }}";
            var id = $(this).data('id');
            var status = $(this).data('status');
            fetch(coverViewRouteTemplate, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content")
                    },
                    body: JSON.stringify({
                        id: id,
                        status: status
                    })
                })
                .then(res => res.json())
                .then(jsonData => {
                    var id = $(this).data('id');
                    let button = document.getElementById('status-btn-' + id);
                    let arr = [
                        'btn-warning',
                        'btn-info',
                        'btn-success',
                        'btn-danger',
                    ];
                    button.classList.remove('btn-warning');
                    button.classList.remove('btn-info');
                    button.classList.remove('btn-success');
                    button.classList.remove('btn-danger');
                    let className = "";
                    if (status == "pending") {
                        className = 'btn-warning';
                    } else if (status == "reviewed") {
                        className = 'btn-info';
                    } else if (status == "accepted") {
                        className = 'btn-success';
                    } else {
                        className = 'btn-danger';
                    }
                    button.classList.add(className);
                    button.innerText = status;
                }).catch(Err => {
                    console.log(Err);

                });
        })




        $(document).on('click', '.view_cover_letter', function() {
            // const pdfUrl = $(this).data('url');
            const coverViewRouteTemplate = "{{ route('jobs.cover.view', ['id' => '__id__']) }}";
            var id = $(this).data('id');
            var url = coverViewRouteTemplate.replace('__id__', id);
            fetch(url).then(async (result) => {
                let jsonData = await result.json();
                console.log("show", jsonData);
                $('#cover_letter_body').html(jsonData.html);
            }).catch((err) => {


                window.alert("error occured while open this file");
            });
            $('#coverModal').modal('show');
        });

        function connectTable() {

        }
        $(document).ready(function() {
            $('#applicatiion-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                initComplete: function() {
                    var $searchInput = $('div.dataTables_filter input');
                    $searchInput.attr('placeholder', 'Search a Job Application');
                    $searchInput.addClass('form-control'); // For Bootstrap style input if needed
                },
                scrollCollapse: true,
                ajax: "{{ route('jobs.applications', $jobId) }}",
                stripeClasses: ['dt-row-odd', 'dt-row-even'],
                columns: [{
                        data: 'user.email',
                        name: 'user.email'
                    },
                    {
                        data: 'experience',
                        name: 'experience',
                        defaultContent: '-'
                    },
                    {
                        data: 'resume',
                        name: 'resume',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'applied_at',
                        name: 'applied_at'
                    },
                    {
                        data: 'cover_letter',
                        name: 'cover_letter'
                    },
                    {
                        data: 'expected_ctc',
                        name: 'expected_ctc'
                    },
                    {
                        data: 'feedback',
                        name: 'feedback',
                        defaultContent: '-'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
        $('#applicatiion-table').on('draw.dt', function() {
            $('.blocked-toggle').off('change').on('change', function() {
                var id = $(this).data('id');
                const baseUrl = window.location.origin;

                toggleActiveJob(id, baseUrl);
            });
        });

        function toggleActiveJob(id, baseUrl) {}
    </script>
@endsection
