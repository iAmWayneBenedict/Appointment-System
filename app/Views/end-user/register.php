<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="center-con" style="width: 100%; padding-top: 5rem;">
    <div class="card border-0" style="width: 25rem;">
        <div class="card-body">
            <h5 class="mb-5">
                <b>Register</b>
            </h5>
            <form id="user-form">
                <div>
                    <label for="">User ID: <span id="user_id"></span></label>
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">
                        Error message!
                    </span>
                </div>
                <br />
                <button id="generate-id" class="btn btn-primary mt-3 rounded-5">Generate User Id</button>
                <br />
                <div class="mb-1">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
                <div class="mb-1">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                </div>
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
                <div class="mb-1">
                    <label for="email" class="form-label">Email <i class="text-primary">(optional)</i></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email / optional">
                </div>
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
                <div class="mb-1">
                    <label for="number" class="form-label">Phone number</label>
                    <input type="text" class="form-control" id="number" name="number" placeholder="number | 09">
                </div>
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
                <div class="mb-1">
                    <label for="identity" class="form-label">Identity</label>
                    <input type="text" class="form-control" id="identity" name="identity" placeholder="Identity">
                </div>
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
                <div class="mb-1">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
                <input type="submit" value="Register" id="submit" class="d-none btn btn-primary mt-3 rounded-5">
            </form>
        </div>
    </div>
</div>
<script>
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
                },
                success: function(res) {
                    if (res.code == 0) {
                        $.each(res.errors, function(key, val) {
                            $(`#${key}`).next().text(val).removeClass('d-none');
                        });
                    } else if (res.code == 1) {
                        window.location.href = `${base_url}/user/reminder/${res.user_id}`
                    } else {
                        alert('Registration problem contact support')
                    }
                },
                complete: function(data) {
                    // Hide image container
                    //hide loading gif
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>