function validatePass() {
    var pass = $('#password').val();
    var cpass = $('#c_password').val();
    $('#reg_user').attr('disabled', true);
    if (pass != cpass) {
        $('#helper-pass').removeClass('no-disp');
        // $('.helper-pass').text('Passwords do not match!')
    } else {
        $('#helper-pass').addClass('no-disp');
        $('#reg_user').removeAttr('disabled');
    }
}

function validateEmailReg() {
    var email = $('#email').val();
    var u_type = $("input[name='u_type']:checked").val();
    $.ajax({
        url: 'checkUser.php',
        type: 'POST',
        cache: false,
        data: {
            email: email,
            type_user: u_type
        },
        success: function(result) {
            if (result == 0) {
                $('#user_validate').removeClass('no-disp');
                $('#reg_user').attr('disabled', true);
            } else {
                $('#user_validate').addClass('no-disp');
                $('#reg_user').removeAttr('disabled');
            }
        }
    });
}

function validateEmailLogin() {
    var email = $('#login_email').val();
    var type = $("input[name='u_type_login']:checked").val();
    $.ajax({
        url: 'checkUserLogin.php',
        type: 'POST',
        cache: false,
        data: {
            email: email,
            type_user: type
        },
        success: function(result) {
            console.log(result);
            if (result == 0) {
                $('#user_validate_login').removeClass('no-disp');
                $('#login_button').attr('disabled', true);
            } else {
                $('#user_validate_login').addClass('no-disp');
                $('#login_button').removeAttr('disabled');
            }
        }
    });
}

$('#reg_user').click(function() {
    var formData = $("#register").serialize();
    /* console.log(formData);
    var username = $(".username").val();
    var email = $(".email").val();
    var password = $(".password").val();
    var c_password = $(".c_password").val();
    var contact = $(".contact").val();
    var city = $(".city").val();
    var pref = $("input[name='pref']:checked").val();
    var r_pref = $("input[name='type']:checked").val();
    var u_type = $("input[name='u_type']:checked").val(); */

    $.ajax({
        url: 'register.php',
        type: 'POST',
        cache: false,
        data: formData,
        success: function(result) {
            // alert("data sent");
            // $('#signup_modal').modal('close');
            if (result == "failed_login") {
                alert("Resistration unsuccessful!");
                //    $('#signup_modal').modal('close');                   
            } else {
                if (result == 1) {
                    window.location.replace("view_restaurants.php");
                } else {
                    window.location.replace("restaurant.php");
                }
            }
        }

    });
});
$('#login_button').click(function(e) {
    var formData = $("#login").serialize();

    $.ajax({
        url: 'login.php',
        type: 'POST',
        cache: false,
        data: formData,
        success: function(result) {
            if (result == "failed_login") {
                alert("Wrong password");
                //    $('#signup_modal').modal('close');                   
            } else {
                // console.log(result);
                if (result == 1) {
                    window.location.replace("view_restaurants.php");
                } else {
                    window.location.replace("restaurant.php");
                }
            }
        }

    });
});

function optionToggleRegister() {
    var type = $("input[name='u_type']:checked").val();
    if (type == "2") {
        $('#food_type').removeClass('no-disp');
        $('#food_pref').addClass('no-disp');
    } else {
        $('#food_type').addClass('no-disp');
        $('#food_pref').removeClass('no-disp');
    }
}

function optionToggleLogin() {
    var type = $("input[name='u_type_login']:checked").val();
    if (type == "2") {
        $('#login_text').text('Restaurant Login');
    } else {
        $('#login_text').text('Customer Login');
    }
}


/* Login modal initialization */
$(document).ready(function() {
    $('#login_modal').modal();
});

/* Signup modal initialization */
$(document).ready(function() {
    $('#signup_modal').modal();
});