require('datatables.net');
window.$ = window.jQuery = require('jquery');

class userApp {
    constructor() {
        console.log('Hello, TMG!');
        this.url = '/users/';
        this._token = $('meta[name="csrf-token"]').attr('content')
        this.activeId = 0;
    }

    test() {
        console.log('This is a loading test Jquery');
        try {
            $('#vmenu').css('background-color', 'lightgreen');
            return true;
        } catch (e) {
            return e.errors
        }
    }

    users(page, table) {
        console.log('Get existing users..');
        return $.post({
            url: this.url + 'index',
            data: {
                _token: this._token,
                data: {
                    page: page
                }
            },
            success: function (data) {
                table.clear();
                table.rows.add(data).draw();
                $(".openModal").click(function (e) {
                    let id = e.target.id;
                    app.activeId = id;
                    app.user(id);
                    $("#myModal").css("display", "block");
                });

                $(".openModalCreate").click(function (e) {
                    $("#myModalCreate").css("display", "block");
                });

                $(".deleteModal").click(function (e) {
                    app.activeId = e.target.id;
                    app.deleteUser();
                });

                $(".close, .modal").click(function () {
                    $("#myModal").css("display", "none");
                    $("#myModalCreate").css("display", "none");
                });

                $(".updateUserData").click(function () {
                    $("#myModal").css("display", "none");
                    app.updateUser();
                });

                $(".createUserData").click(function () {
                    $("#myModalCreate").css("display", "none");
                    app.addUser();
                });

                $(".modal-content").click(function (e) {
                    e.stopPropagation();
                });
            }
        });
    }

    user() {
        console.log('Get user by id = ' + this.activeId);
        $('#user_name').val('')
        $('#user_email').val('')
        $('#user_password').val('')
        $.ajax({
            url: this.url + this.activeId,
            type: 'GET',
            data: {
                _token: this._token,
                id: this.activeId
            },
            success: function (response) {
                $('#user_name').val(response.name)
                $('#user_email').val(response.email)
                $('#user_password').val(response.password)
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    updateUser() {
        $.ajax({
            url: this.url + this.activeId,
            type: 'PATCH',
            data: {
                _token: this._token,
                user_name: $('#user_name').val(),
                user_email: $('#user_email').val(),
                user_phone: $('#user_phone').val(),
                user_password: $('#user_password').val(),
                id: this.activeId
            },
            success: function (response) {
                console.log(response);
                $("#myModal").css("display", "none");
                app.users(0, table);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    deleteUser() {
        $.ajax({
            url: this.url + this.activeId,
            type: 'DELETE',
            data: {
                _token: this._token,
                id: this.activeId
            },
            success: function (response) {
                console.log(response);
                app.users(0, table);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    addUser() {
        $.ajax({
            url: this.url + 'create',
            type: 'POST',
            data: {
                _token: this._token,
                user_name: $('#user_name_c').val(),
                user_email: $('#user_email_c').val(),
                user_phone: $('#user_phone_c').val(),
                user_password: $('#user_password').val(),
            },
            success: function (response) {
                console.log(response);
                $("#myModal").css("display", "none");
                app.users(0, table);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });

        //return this.userRequest(args);
    }

    init(table) {
        this.table = table;
        this.users(0, table);
        console.log('Initialization completed.');
    }
}

let table = $('#userTable').DataTable({
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
    createdRow: function (row, data, dataIndex) {
        //$(row).addClass('greenClass').removeClass('odd');
    },
    color: "green"
});
let app = new userApp();
app.init(table);
