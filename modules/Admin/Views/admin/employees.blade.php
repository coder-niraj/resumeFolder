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
            @include('admin::components.sidebar', ['active' => 'employees'])
        </div>
        <div class="w-100 input-bg" style="overflow: hidden;">
            <div class="m-3 bg-white p-3">
                <div class="container pt-4" style="border-radius: 5px;border-top: 5px solid black;">
                    <table id="employees-table" class=" user-table ">
                        <thead class="user-table-head">
                            <tr class="user-table-head-row">
                                {{-- <th>ID</th> --}}
                                <th>Name</th>
                                <th>Email</th>
                                <th>company_name</th>
                                <th>company_website</th>
                                <th>phone</th>
                                <th>status</th>
                                <th>created_at</th>
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
        $(document).ready(function() {
            $('#employees-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                initComplete: function() {
                    var $searchInput = $('div.dataTables_filter input');
                    $searchInput.attr('placeholder', 'Search a Employee');
                    $searchInput.addClass('form-control'); // For Bootstrap style input if needed
                },
                scrollCollapse: true,
                ajax: "{{ route('admin.employees.data') }}",
                stripeClasses: ['dt-row-odd', 'dt-row-even'],
                columns: [
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },

                    {
                        data: 'company_website',
                        name: 'company_website'
                    },

                    {
                        data: 'phone',
                        name: 'phone'
                    },

                    {
                        data: 'status',
                        name: 'status'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ]
            });
        });
        $('#employees-table').on('draw.dt', function() {
            $('.blocked-toggle').off('change').on('change', function() {
                var email = $(this).data('email');
                const baseUrl = window.location.origin;
                console.log('Toggled checkbox for user email:', email);
                console.log('Base URL:', baseUrl);
                toggleEmployeeStatus(email, baseUrl);
            });
        });



        function toggleEmployeeStatus(email, baseUrl) {

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(baseUrl + '/admin/toggle/employee', {
                method: 'POST', // or 'PUT', 'DELETE', etc.
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    // your data here
                    email
                })
            })
            // .then(() => {
            //     showToast('Employee status updated successfully!', 'success');
            // }).catch(() => {
            //     showToast('error occurred', 'error');
            // });
        }
    </script>
@endsection
