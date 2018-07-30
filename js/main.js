$(document).ready(function() {
    $("#login_link").on("click", function(event) {
        event.preventDefault();

        var link = $(this).attr("href");

        $("body").load(link);
    });

    $("#users_link").on("click", function(event) {
        event.preventDefault();

        var link = $(this).attr("href");

        $("body").load(link);
    });

    $("#user_link").on("click", function(event) {
        event.preventDefault();

        var link = $(this).attr("href");

        $("body").load(link);
    });

    $("#home_link").on("click", function(event) {
        event.preventDefault();

        var link = $(this).attr("href");

        $("body").load(link);
    });

    $("#registration_link").on("click", function(event) {
        event.preventDefault();

        var link = $(this).attr("href");

        $("body").load(link);
    });

    $("#registration_form_submit").on("click", function(event) {
        event.preventDefault();

        var link = $(this).attr("href");

        $.ajax({
            url: link,
            method: 'post',
            cache: false,
            data: {
                registration_login: $("#registration_form_login").val(),
                registration_password: $("#registration_form_password").val()
            }
        }).done(function(response)
        {


        });
    });

    $("#login_form_submit").on("click", function(event) {
        event.preventDefault();

        var link = $(this).attr("href");


        $.ajax({
            url: link,
            method: 'post',
            cache: false,
            data: {
                login_login: $("#login_form_login").val(),
                login_password: $("#login_form_password").val()
            }
        }).done(function(response)
        {
            var message = JSON.parse(response);

            if(message['login_success'] == 'success')
            {
                window.location.reload();
            }
        });
    });


});
