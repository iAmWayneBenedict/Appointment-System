<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base_url" content="<?= base_url() ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Document</title>
</head>
<body>
    <form id="user-form">
        <div>User ID:  <span id="user_id"></span> 
            <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                        message!</span>
        </div> <br>
        <button id="generate-id">Generate User Id</button><br>
        <input type="text" name="name" id="name" placeholder="Name">
        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                    message!</span><br>
        <input type="text" name="address" id="address" placeholder="address">
        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                    message!</span><br>
        <input name="email" id="email" placeholder="email / optional">
        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                    message!</span><br>
        <input type="text" name="number" id="number" placeholder="number | 09">
        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                    message!</span><br>
        <input type="text" name="identity" id="identity" placeholder="identity">
        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                    message!</span><br>
        <input type="text" name="password" id="password" placeholder="password">
        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                    message!</span><br>
        <input type="submit" value="Register" id="submit" class="d-none">
    </form>
</body>
</html>
<script>
    $(document).ready(function () {
        const base_url = document.querySelector("meta[name = base_url]").getAttribute('content');


        $('#generate-id').click(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "get",
                url: `${base_url}/user/generate-id`,
                success: function (response) {
                    $('#user_id').html(response)
                    $('#generate-id').remove()
                    $('#submit').removeClass('d-none');
                }
            });
        });


        $('#user-form').submit(function (e) { 
            e.preventDefault();
            $('.text-danger').addClass('d-none');
            $.ajax({
                type: "post",
                url: `${base_url}/user/register-user`,
                data: {
                    user_id : $('#user_id').text(),
                    name : $('#name').val(),
                    address : $('#address').val(),
                    email : $('#email').val(),
                    number : $('#number').val(),
                    identity : $('#identity').val(),
                    password : $('#password').val()
                },
                dataType: "json",
                beforeSend: function(){
                    // Show image container
                    //show loading gif
                },
                success: function (res) {
                    if(res.code == 0){
                        $.each(res.errors, function(key, val) {
                            $(`#${key}`).next().text(val).removeClass('d-none');
                        });
                    }
                    else if(res.code == 1){
                        window.location.href = `${base_url}/user/reminder/${res.user_id}`
                    }
                    else{
                        alert('Registration problem contact support')
                    }
                },
                complete:function(data){
                    // Hide image container
                    //hide loading gif
                }
            });
        });
    });
</script>