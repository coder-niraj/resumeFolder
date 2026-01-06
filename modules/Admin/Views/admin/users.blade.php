@extends('admin::layouts.app')
@section('title', 'admin-login')
@section('header')
@endsection
@section('style')
@endsection
@section('content')

    <div class="d-flex">
        <div class="">
            @include('admin::components.sidebar', ['active' => 'users'])
        </div>
        <div class="w-100 input-bg" style=" overflow: hidden;">
            <div class="m-3 bg-white p-3">
                <div class="container pt-4" style=" border-radius: 5px;border-top: 5px solid black;">
                    <table id="users-table" class=" employee-table ">
                        <thead class="employee-table-head">
                            <tr class="employee-table-head-row">
                                {{-- <th>ID</th> --}}
                                <th class="">Name</th>
                                <th class="">Email</th>
                                <th>phone</th>
                                <th>blocked</th>
                                <th>created_at</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,

                scrollCollapse: true,
                paging: true,

                autoWidth: false,
                ajax: "{{ route('admin.users.data') }}",
                initComplete: function() {
                    var $searchInput = $('div.dataTables_filter input');
                    $searchInput.attr('placeholder', 'Search a User');
                    $searchInput.addClass('form-control'); // For Bootstrap style input if needed

                },
                stripeClasses: ['dt-row-odd', 'dt-row-even'],
                columns: [
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'col-name'
                    },

                    {
                        data: 'email',
                        name: 'email'
                    },


                    {
                        data: 'phone',
                        name: 'phone'
                    },

                    {
                        data: 'blocked',
                        name: 'blocked',

                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ]
            });
        });

        $('#users-table').on('draw.dt', function() {
            $('.blocked-toggle').off('change').on('change', function() {
                var email = $(this).data('email');
                const baseUrl = window.location.origin;
                console.log('Toggled checkbox for user email:', email);
                toggleUserBlock(email, baseUrl)
            });
        });

        function toggleUserBlock(email, baseUrl) {

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(baseUrl + '/admin/toggle/user', {
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
