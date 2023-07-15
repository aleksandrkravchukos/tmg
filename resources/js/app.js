window.$ = window.jQuery = require('jquery');
console.log('Hello, TMG!');

let app = {
    url: '/users/',
    test: function () {
        console.log('Testing jquery..');
        $('body').css('background-color', '#f0f0f0')
        console.log('Make sure that background changed to #f0f0f0..');
    },
    users: function () {
        console.log('Get existing users..');
        return this.userRequest({
                url: this.url
            }
        );
    },
    user: function (id) {
        console.log('Get user by id..');
        return this.userRequest({
                url: this.url + id
            }
        );
    },
    addUser: function (args) {
        return this.userRequest(args);
    },
    updateUser: function (args) {
        return this.userRequest(args);
    },
    deleteUser: function (args) {
        return this.userRequest(args);
    },
    userRequest: function (args) {
        console.log(args);
        // AXIOS
    }
};

console.log(app.users());
