window.$ = window.jQuery = require('jquery');

class userApp {
    constructor() {
        console.log('Hello, TMG!');
        this.url = '/users/';
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
                _token: $('meta[name="csrf-token"]').attr('content'),
                data: {
                    action: 'getAllUsers',
                    page: page
                }
            },
            success: function(data) {
                table.rows.add(data).draw();
            }
        });
    }
    user(id) {
        console.log('Get user by id..');
        return this.userRequest({
            url: this.url + id,
            method: 'GET',
            data: {
                userId: id,
                action: 'getAllUsers'
            }
        }, function (data) {
            alert(data);
        });
    }
    updateUser(args) {
        return this.userRequest(args);
    }
    deleteUser(args) {
        return this.userRequest(args);
    }
    userRequest(args) {
        return false;
    }
    addUser(args) {
        return this.userRequest(args);
    }
    updateDataTable(data) {
        console.log(data)
    }
    init() {
        console.log('Initialization completed.');
    }
}

window.userApp = new userApp();
