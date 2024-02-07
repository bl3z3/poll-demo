$(document).ready(function () {
    var $username = $("#userName");
    var $password = $("#password");
    var $newUsername = $("#newUserName");
    var $newPassword = $("#newPassword");
    var $register = $("#register");
    var $login = $("#login");
    var $logout = $("#logout");

    function login() {
        var usernameString = $username.val();
        var passwordString = $password.val();
        $.get('ajax/user/login.php', {
            username: usernameString,
            password: passwordString
        });

        location.reload();
    }

    function logout() {
        $.get('ajax/user/logout.php', {});
        location.reload();
    }

    function register() {
        var newUsernameString = $newUsername.val();
        var newPasswordString = $newPassword.val();

        $.get('ajax/user/register.php', {
            newUsername: newUsernameString,
            newPassword: newPasswordString
        });

        $("#myModal").modal('toggle');
    }

    $register.click(function () {
        register();
    });

    $login.click(function () {
        login();
    });

    $logout.click(function () {
        logout();
    })

});