@extends('application::layouts.app')
@section('title', 'employee')
@section('header')
@endsection
@section('style')
@endsection
@section('content')
    <div class="d-flex">
        @include('application::components.pdf-view-modal')
        @include('application::components.cover-letter-view-modal')
        <div class="">
            @include('application::components.sidebar', ['active' => 'application'])
        </div>
        <div class="w-100 input-bg">
            <div class="m-3 bg-white">
                <div class="container " style="height: 95vh;border-radius: 5px;border-top: 5px solid black;">
                    <table id="job-application-table" class=" user-table ">
                        <thead class="user-table-head">
                            <tr class="user-table-head-row">
                                {{-- <th>ID</th> --}}
                                <th>title</th>
                                <th>resume</th>
                                <th>applied at</th>
                                <th>cover latter</th>

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
        $(document).ready(function() {
            $('#job-application-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                initComplete: function() {
                    var $searchInput = $('div.dataTables_filter input');
                    $searchInput.attr('placeholder', 'Search Application');
                    $searchInput.addClass('form-control'); // For Bootstrap style input if needed
                },
                scrollCollapse: true,
                ajax: "{{ route('application.applications') }}",
                stripeClasses: ['dt-row-odd', 'dt-row-even'],
                columns: [{
                        data: 'job.title',
                        name: 'job.title'
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
    </script>
@endsection
