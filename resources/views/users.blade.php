@extends('layout.users')
@section('title', 'Users. CRUD test task')

@section('user-content')


    <div class="main-content">
        <div class="top-panel">
            User list
        </div>

        <table id="userTable" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>

        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla faucibus tristique libero, id rutrum tellus
        tristique a. Mauris eleifend mi auctor, scelerisque lacus ut, fermentum enim. Fusce volutpat leo a enim
        convallis, a consequat purus convallis. Vestibulum convallis, ligula non cursus fringilla, neque sapien finibus
        mauris, id luctus neque sem et elit. Nullam facilisis auctor diam ut auctor. Nullam id feugiat justo. Vestibulum
        auctor enim lacus, eu venenatis ipsum tincidunt a. Mauris in nisi sed purus fringilla pulvinar. Cras eleifend
        convallis erat a lobortis.
        Sed fringilla sollicitudin justo ac pellentesque. Morbi viverra semper lacus in pellentesque. Fusce vel justo
        sed justo iaculis laoreet. Sed a elit vulputate, tempor quam non, dapibus sapien. Mauris id faucibus metus.
        Proin consequat dui nec tortor lobortis, vitae efficitur ex cursus. Aliquam vestibulum sapien non leo venenatis
        facilisis. Sed eu pellentesque lorem. Sed scelerisque, tellus sit amet malesuada lobortis, nisl nisl lobortis
        metus, ut lobortis lacus lectus ac ex. Donec ultricies euismod nunc, a iaculis metus pharetra eu. Aliquam vitae
        feugiat elit, vel consectetur orci. In venenatis, erat sed venenatis gravida, sem nunc gravida massa, in cursus
        nulla sem id sapien.
        Please note that "Lorem ipsum" is a placeholder text commonly used in the design and typesetting industry to
        demonstrate the visual effects of different fonts, layouts, and designs without the distraction of meaningful
        content. It does not carry any specific meaning or message.
    </div>
@endsection

@push('custom-js')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>


        $('#myTable').DataTable({
            ajax: {
                url: '/users',
                dataSrc: ''
            },
            columns: [
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' }
            ]
        });
    </script>
@endpush
