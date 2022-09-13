$(document).ready(function() {
    const base_url = document.querySelector("meta[name = base_url]").getAttribute('content');


    $('#generate-id').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: `${base_url}/user/generate-id`,
            success: function(response) {
                $('#user_id').html(response)
                $('#generate-id').remove()
                $('#submit').removeClass('d-none');
            }
        });
    });


    $('#user-form').submit(function(e) {
        e.preventDefault();
        $('.text-danger').addClass('d-none');
        $.ajax({
            type: "post",
            url: `${base_url}/user/register-user`,
            data: {
                user_id: $('#user_id').text(),
                name: $('#name').val(),
                address: $('#address').val(),
                email: $('#email').val(),
                number: $('#number').val(),
                identity: $('#identity').val(),
                password: $('#password').val()
            },
            dataType: "json",
            beforeSend: function() {
                // Show image container
                //show loading gif
                console.log('please wait....');
                $('.loading').removeClass('d-none')
            },
            success: function(res) {
                if (res.code == 0) {
                    $.each(res.errors, function(key, val) {
                        $(`#${key}`).next().text(val).removeClass('d-none');
                    });
                    return;
                } else if(res.code == 1) {
                    console.log(res.sms_res)
                    Swal.fire({
                        icon: 'success',
                        title: 'Registered',
                        text: res.msg,
                        footer: '<a href="'+ `${base_url}/user/login`+'">Take me to Login</a>'
                    })
                    $('#user-form').trigger("reset")
                    return ;
                } 

                console.log(res.sms_res)
                Swal.fire(
                    'Sorry',
                    res.msg,
                    'error'
                )
            },
            complete: function(data) {
                // Hide image container
                //hide loading gif
                console.log('Sent');
                $('.loading').addClass('d-none')
            }
        });
    });
});