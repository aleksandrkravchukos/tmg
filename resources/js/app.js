require('datatables.net');
const stringifySafe = require('json-stringify-safe');
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

    clearForm() {
        $('#myModalCreate input').val('');
        $('#myModal input').val('');
    }

    validateCreateUser() {
        let errors = [];
        let isValid = true;
        let name = $('input[name="name"]').val();
        let email = $('input[name="email"]').val();
        let phone = $('input[name="phone"]').val();
        let password = $('input[name="password"]').val();
        let password2 = $('input[name="password2"]').val();

        if (name.trim() === '') {
            isValid = false;
            errors.push({error: 'Name not valid'});
        }

        if (email.trim() === '') {
            isValid = false;
            errors.push({error: 'Email not valid'});
        }

        if (phone.trim() === '') {
            isValid = false;
            errors.push({error: 'Phone not valid'});
        }

        if (password.trim() === '') {
            isValid = false;
            errors.push({error: 'Password2 not valid'});
        }

        if (password2.trim() === '') {
            isValid = false;
            errors.push({error: 'Password not valid'});
        } else if (password !== password2) {
            errors.push({error: 'Password2 not valid'});
            isValid = false;
        }

        if (isValid) {
            console.log('Validation success');
            return true;
        }

        return errors;
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
                if (data) {
                    table.clear();
                    table.rows.add(data).draw();
                }
                $(".openModal").click(function (e) {
                    let id = e.target.id;
                    app.activeId = id;
                    app.user(id);
                    $("#myModal").css("display", "block");
                });

                $(".openModalCreate").click(function (e) {
                    app.clearForm()
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
                    app.addUser(table);
                });

                $(".modal-content").click(function (e) {
                    e.stopPropagation();
                });
            }
        });
    }

    user() {
        console.log('Get user by id = ' + this.activeId);
        app.clearForm();
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
                $('#user_phone').val(response.phone)
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

        Swal.fire({
            title: "Please type 'DELETE' for confirm",
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: (name) => {
                if (name) {
                    console.log(`Entered name: ${name}`);
                }
            }
        }).then((result) => {
            if (result.isConfirmed && result.value === 'DELETE') {
                console.log('Admin confirmed deleting user');
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Done.',
                            text: 'User deleted'
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'You are a robot.',
                    text: 'Delete not confirmed'
                });
            }
        });
    }

    addUser(table) {
        let validation = this.validateCreateUser();
        console.log(validation);
        if (validation === true) {
            $("#myModalCreate").css("display", "none");
            $.ajax({
                url: this.url + 'create',
                type: 'POST',
                data: {
                    _token: this._token,
                    user_name: $('#user_name_c').val(),
                    user_email: $('#user_email_c').val(),
                    user_phone: $('#user_phone_c').val(),
                    user_password: $('#user_password_c').val(),
                },
                success: function (response) {
                    console.log(response);
                    $("#myModal").css("display", "none");
                    Swal.fire({
                        icon: 'success',
                        title: 'Done.',
                        text: 'User created'
                    });
                    app.users(0, table);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong.',
                        text: 'User not created'
                    });
                }
            });
        } else {
            let icon = 'warning';
            let title = 'Validation error';
            let jsonErrorMessage = stringifySafe(validation);
            Swal.fire({
                icon: icon,
                title: title,
                text: jsonErrorMessage
            });
        }
    }

    init(table) {
        this.users(0, table);
        console.log('Initialization completed.');
    }
}

let table = $('#userTable').DataTable({
    columnDefs: [
        {"width": "20px", "targets": 0, className: "dt-head-left"},
        {"width": "200px", "targets": 1, className: "dt-head-left"},
        {"width": "220px", "targets": 2, className: "dt-head-left"},
        {"width": "150px", "targets": 3, className: "dt-head-left"},
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
let Swal = require('sweetalert2');
app.init(table);
