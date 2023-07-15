@extends('layout.users')
@section('title', 'Users. CRUD test task')

@push('custom-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endpush
@section('user-content')
    <div class="main-content">
        <div class="top-panel">
            User list
        </div>
        <table id="userTable" class="display">
            <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Make</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@push('custom-js')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $.noConflict();
        jQuery(function ($) {
            let app = window.userApp;
            let table = $('#userTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        charset: 'UTF-8',
                        bom: true,
                        filename: 'userExport',
                        title: 'Export'
                    },
                    {
                        extend: 'print',
                        className: 'btn-sm'
                    }
                ],
                columnDefs: [
                    {"width": "20px", "targets": 0},
                    {"width": "200px", "targets": 1},
                    {"width": "220px", "targets": 2},
                    {"width": "150px", "targets": 3},
                ],
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'phone'},
                    {data: 'make'},
                ],
                lengthMenu: [10, 20, 50],
                responsive: false,
                autoFill: true,
                colReorder: true,
                order: [[0, 'desc']],
                keys: {
                    columns: ':not(:first-child)'
                },
                select: {
                    style: 'os',
                    selector: 'td:first-child',
                    blurable: true
                },
                rowReorder: false,
                "createdRow": function (row, data, dataIndex) {
                    if (data.declared > 150) {
                        $(row).addClass('greenClass').removeClass('odd');
                    }
                    // } else if (data.declared > 150) {
                    //     $(row).addClass('redClass').removeClass('odd');
                    // }
                },
                color: "green"
            });
            app.init();
            app.users(0, table)
        });
    </script>
@endpush
